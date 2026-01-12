<?php
/**
 * 🔒 IRON DOME — CONTENT CENSORSHIP ENGINE
 * Smarter.Poker - Financial Protection Layer
 * 
 * Automatically redacts financial keywords to prevent off-platform transactions.
 */

// ═══════════════════════════════════════════════════════════════════════════
// 🛡️ IRON DOME - CENSORSHIP REGEX PATTERNS
// ═══════════════════════════════════════════════════════════════════════════

define('IRON_DOME_PATTERNS', [
    // Payment Apps
    '/\b(venmo)\b/i',
    '/\b(paypal)\b/i',
    '/\b(cashapp|cash\s*app)\b/i',
    '/\b(zelle)\b/i',
    '/\b(apple\s*pay)\b/i',
    '/\b(google\s*pay)\b/i',
    '/\b(samsung\s*pay)\b/i',
    
    // Crypto
    '/\b(bitcoin|btc)\b/i',
    '/\b(ethereum|eth)\b/i',
    '/\b(crypto)\b/i',
    '/\b(usdt|tether)\b/i',
    '/\b(wallet\s*address)\b/i',
    '/\b(send\s*me\s*(money|cash|funds))\b/i',
    
    // Wire/Bank
    '/\b(wire\s*transfer)\b/i',
    '/\b(routing\s*number)\b/i',
    '/\b(account\s*number)\b/i',
    '/\b(swift\s*code)\b/i',
    '/\b(iban)\b/i',
    
    // Gambling-specific terms (off-platform)
    '/\b(stake(?!r))\b/i', // "stake" but not "staker"
    '/\b(bovada)\b/i',
    '/\b(betonline)\b/i',
    '/\b(ignition\s*casino)\b/i',
    
    // Solicitation patterns
    '/\$[\d,]+(\.\d{2})?\s*(for|to)\s*(play|game|session)/i',
    '/(dm|message)\s*me\s*for\s*(payment|money|transfer)/i',
    '/meet\s*(me\s*)?(at|on)\s*(venmo|paypal|cashapp)/i',
    
    // Phone numbers (prevent off-platform contact for money)
    '/\b\d{3}[-.\s]?\d{3}[-.\s]?\d{4}\b/',
    
    // Email addresses (prevent off-platform contact)
    '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/',
]);

// Replacement text
define('IRON_DOME_REPLACEMENT', '[REDACTED]');

/**
 * Apply Iron Dome censorship to content
 * 
 * @param string $content The content to filter
 * @return string Filtered content with redacted terms
 */
function apply_iron_dome($content) {
    if (empty($content) || !is_string($content)) {
        return $content;
    }
    
    foreach (IRON_DOME_PATTERNS as $pattern) {
        $content = preg_replace($pattern, IRON_DOME_REPLACEMENT, $content);
    }
    
    return $content;
}

/**
 * Check if content contains blocked terms
 * 
 * @param string $content The content to check
 * @return bool True if content contains blocked terms
 */
function iron_dome_detect($content) {
    if (empty($content) || !is_string($content)) {
        return false;
    }
    
    foreach (IRON_DOME_PATTERNS as $pattern) {
        if (preg_match($pattern, $content)) {
            return true;
        }
    }
    
    return false;
}

/**
 * Get list of detected violations
 * 
 * @param string $content The content to analyze
 * @return array List of matched violations
 */
function iron_dome_violations($content) {
    $violations = [];
    
    if (empty($content) || !is_string($content)) {
        return $violations;
    }
    
    foreach (IRON_DOME_PATTERNS as $pattern) {
        if (preg_match_all($pattern, $content, $matches)) {
            foreach ($matches[0] as $match) {
                $violations[] = $match;
            }
        }
    }
    
    return array_unique($violations);
}

// ═══════════════════════════════════════════════════════════════════════════
// 🎨 SMARTER.POKER BRANDING
// ═══════════════════════════════════════════════════════════════════════════

define('SMARTER_POKER_BRAND', [
    'name' => 'Smarter.Poker',
    'tagline' => 'Train Smarter. Win Bigger.',
    'primary_color' => '#FF6B35',      // Club Orange
    'secondary_color' => '#00FFFF',    // Cyan Accent
    'background_dark' => '#0A0F1E',    // Deep Space
    'text_primary' => '#FFFFFF',
    'text_secondary' => 'rgba(255, 255, 255, 0.6)',
]);
