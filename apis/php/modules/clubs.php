<?php
/**
 * Club Page API - Create and manage club/venue pages
 * 
 * Endpoints:
 *   POST /api/clubs/create - Create a new club page
 *   GET /api/clubs/{id} - Get club page details
 *   PUT /api/clubs/{id} - Update club page
 *   DELETE /api/clubs/{id} - Delete club page
 */

// CORS headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Load config
require_once __DIR__ . '/../libs/config.php';
require_once __DIR__ . '/../libs/database.php';
require_once __DIR__ . '/../libs/auth.php';

/**
 * Create a new club page
 */
function createClubPage($data) {
    global $db;
    
    // Validate required fields
    $required = ['venue_id', 'name', 'owner_id'];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            return ['error' => "Missing required field: {$field}", 'status' => 400];
        }
    }
    
    // Generate slug from name
    $slug = generateSlug($data['name']);
    
    // Check if slug exists
    $existing = $db->query("SELECT id FROM pages WHERE page_slug = ?", [$slug])->fetch();
    if ($existing) {
        $slug = $slug . '-' . $data['venue_id'];
    }
    
    // Create the page
    $pageData = [
        'page_type' => 'club',
        'page_slug' => $slug,
        'page_name' => $data['name'],
        'page_description' => $data['description'] ?? "Welcome to {$data['name']}",
        'page_category' => 'poker_room',
        'page_cover' => $data['cover_photo_url'] ?? null,
        'page_avatar' => $data['logo_url'] ?? null,
        'page_owner' => $data['owner_id'],
        'venue_id' => $data['venue_id'],
        'address' => $data['address'] ?? null,
        'city' => $data['city'] ?? null,
        'state' => $data['state'] ?? null,
        'country' => $data['country'] ?? 'US',
        'website' => $data['website'] ?? null,
        'phone' => $data['phone'] ?? null,
        'email' => $data['email'] ?? null,
        'settings' => json_encode([
            'allow_posts' => true,
            'allow_events' => true,
            'allow_reviews' => true,
            'show_games' => true,
            'show_tournaments' => true,
            'moderation' => 'none'
        ]),
        'verified' => 1,
        'active' => 1,
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    try {
        $pageId = $db->insert('pages', $pageData);
        
        // Create default sections
        createDefaultSections($pageId);
        
        // Add owner as admin
        $db->insert('page_members', [
            'page_id' => $pageId,
            'user_id' => $data['owner_id'],
            'role' => 'admin',
            'joined_at' => date('Y-m-d H:i:s')
        ]);
        
        // Create welcome post
        $db->insert('posts', [
            'page_id' => $pageId,
            'user_id' => $data['owner_id'],
            'post_type' => 'announcement',
            'post_text' => "Welcome to {$data['name']}! We're excited to connect with our poker community here. Follow us for updates on games, tournaments, and promotions.",
            'created_at' => date('Y-m-d H:i:s')
        ]);
        
        $pageUrl = getBaseUrl() . "/club/{$slug}";
        
        return [
            'success' => true,
            'page_id' => $slug,
            'page_url' => $pageUrl,
            'internal_id' => $pageId
        ];
        
    } catch (Exception $e) {
        return ['error' => 'Failed to create club page: ' . $e->getMessage(), 'status' => 500];
    }
}

/**
 * Get club page details
 */
function getClubPage($slugOrId) {
    global $db;
    
    $page = $db->query(
        "SELECT * FROM pages WHERE page_slug = ? OR id = ? OR venue_id = ?",
        [$slugOrId, $slugOrId, $slugOrId]
    )->fetch();
    
    if (!$page) {
        return ['error' => 'Club page not found', 'status' => 404];
    }
    
    // Get member count
    $memberCount = $db->query(
        "SELECT COUNT(*) as count FROM page_members WHERE page_id = ?",
        [$page['id']]
    )->fetch()['count'];
    
    // Get recent posts
    $posts = $db->query(
        "SELECT * FROM posts WHERE page_id = ? ORDER BY created_at DESC LIMIT 5",
        [$page['id']]
    )->fetchAll();
    
    return [
        'success' => true,
        'page' => [
            'id' => $page['page_slug'],
            'name' => $page['page_name'],
            'description' => $page['page_description'],
            'avatar' => $page['page_avatar'],
            'cover' => $page['page_cover'],
            'venue_id' => $page['venue_id'],
            'address' => $page['address'],
            'city' => $page['city'],
            'state' => $page['state'],
            'website' => $page['website'],
            'member_count' => $memberCount,
            'verified' => (bool)$page['verified'],
            'url' => getBaseUrl() . "/club/{$page['page_slug']}"
        ],
        'recent_posts' => $posts
    ];
}

/**
 * Update club page
 */
function updateClubPage($slugOrId, $data, $userId) {
    global $db;
    
    // Get page
    $page = $db->query(
        "SELECT * FROM pages WHERE page_slug = ? OR id = ?",
        [$slugOrId, $slugOrId]
    )->fetch();
    
    if (!$page) {
        return ['error' => 'Club page not found', 'status' => 404];
    }
    
    // Check permissions
    $member = $db->query(
        "SELECT role FROM page_members WHERE page_id = ? AND user_id = ?",
        [$page['id'], $userId]
    )->fetch();
    
    if (!$member || !in_array($member['role'], ['admin', 'owner'])) {
        return ['error' => 'Permission denied', 'status' => 403];
    }
    
    // Allowed fields to update
    $allowedFields = [
        'page_name', 'page_description', 'page_avatar', 'page_cover',
        'address', 'city', 'state', 'website', 'phone', 'email', 'settings'
    ];
    
    $updateData = [];
    foreach ($allowedFields as $field) {
        $inputField = str_replace('page_', '', $field);
        if (isset($data[$inputField])) {
            $updateData[$field] = $data[$inputField];
        }
    }
    
    if (empty($updateData)) {
        return ['error' => 'No valid fields to update', 'status' => 400];
    }
    
    $updateData['updated_at'] = date('Y-m-d H:i:s');
    
    try {
        $db->update('pages', $updateData, ['id' => $page['id']]);
        return ['success' => true, 'message' => 'Club page updated'];
    } catch (Exception $e) {
        return ['error' => 'Failed to update: ' . $e->getMessage(), 'status' => 500];
    }
}

/**
 * Helper: Generate URL-safe slug
 */
function generateSlug($name) {
    $slug = strtolower(trim($name));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

/**
 * Helper: Create default page sections
 */
function createDefaultSections($pageId) {
    global $db;
    
    $sections = [
        ['name' => 'About', 'type' => 'about', 'order' => 1],
        ['name' => 'Live Games', 'type' => 'games', 'order' => 2],
        ['name' => 'Tournaments', 'type' => 'tournaments', 'order' => 3],
        ['name' => 'Photos', 'type' => 'photos', 'order' => 4],
        ['name' => 'Reviews', 'type' => 'reviews', 'order' => 5]
    ];
    
    foreach ($sections as $section) {
        $db->insert('page_sections', [
            'page_id' => $pageId,
            'section_name' => $section['name'],
            'section_type' => $section['type'],
            'section_order' => $section['order'],
            'active' => 1
        ]);
    }
}

/**
 * Helper: Get base URL
 */
function getBaseUrl() {
    return defined('SOCIAL_HUB_URL') ? SOCIAL_HUB_URL : 'https://social.smarter.poker';
}

// ============================================
// ROUTER
// ============================================

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathParts = explode('/', trim($path, '/'));

// Verify API key for external requests
$apiKey = $_SERVER['HTTP_AUTHORIZATION'] ?? $_SERVER['HTTP_X_API_KEY'] ?? null;
if ($apiKey) {
    $apiKey = str_replace('Bearer ', '', $apiKey);
}

// For internal requests (same server), skip API key check
$isInternal = strpos($_SERVER['HTTP_HOST'] ?? '', 'smarter.poker') !== false;

if (!$isInternal && !verifyApiKey($apiKey)) {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid API key']);
    exit;
}

// Get request body
$input = json_decode(file_get_contents('php://input'), true) ?? [];

// Route handling
try {
    switch ($method) {
        case 'POST':
            // POST /api/clubs/create
            $result = createClubPage($input);
            break;
            
        case 'GET':
            // GET /api/clubs/{id}
            $clubId = $pathParts[count($pathParts) - 1] ?? null;
            if (!$clubId || $clubId === 'clubs') {
                $result = ['error' => 'Club ID required', 'status' => 400];
            } else {
                $result = getClubPage($clubId);
            }
            break;
            
        case 'PUT':
            // PUT /api/clubs/{id}
            $clubId = $pathParts[count($pathParts) - 1] ?? null;
            $userId = $input['user_id'] ?? null;
            if (!$clubId) {
                $result = ['error' => 'Club ID required', 'status' => 400];
            } else {
                $result = updateClubPage($clubId, $input, $userId);
            }
            break;
            
        default:
            $result = ['error' => 'Method not allowed', 'status' => 405];
    }
    
    $status = $result['status'] ?? 200;
    unset($result['status']);
    
    http_response_code($status);
    echo json_encode($result);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}
