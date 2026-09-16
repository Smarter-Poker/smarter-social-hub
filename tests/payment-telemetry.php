<?php
// Real payment helpers and HTTP transport, with responses isolated from the network.
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/includes/functions.php';
require dirname(__DIR__) . '/includes/cashfree-client.php';
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

function check($ok, $message) { if (!$ok) throw new \RuntimeException($message); }
function offlineClient(array $settings, array $responses, array &$history): CashfreePaymentClient {
  $history = [];
  $stack = HandlerStack::create(new MockHandler($responses));
  $stack->push(Middleware::history($history));
  return new CashfreePaymentClient($settings, new Client(['handler' => $stack]));
}
$system = ['system_url' => 'https://example.test', 'system_currency' => 'USD',
  'cashfree_client_id' => 'fixture-client', 'cashfree_client_secret' => 'fixture-secret',
  'cashfree_mode' => 'sandbox', 'payment_vat_enabled' => false, 'payment_fees_enabled' => false];

// These four exact requests were captured from the original pinned SDK using its
// real request serializers with a Guzzle MockHandler. No network was accessed.
$history = [];
$wire = json_decode(file_get_contents(__DIR__ . '/fixtures/cashfree-wire.json'), true, 512, JSON_THROW_ON_ERROR);
foreach (['sandbox', 'production'] as $mode) {
  $system['cashfree_mode'] = $mode;
  $expected = array_values(array_filter($wire, fn($row) => $row['mode'] === $mode));
  $client = offlineClient($system, [new Response(200, [], '{"payment_session_id":"fixture-session"}'), new Response(200, [], '[{"payment_status":"SUCCESS"}]')], $history);
  check($client->createOrder(json_decode($expected[0]['body'], true)) === $expected[0]['session'], 'Session contract changed');
  check($client->firstPaymentSucceeded('order /?+%') === true, 'Success contract changed');
  foreach ($history as $index => $row) {
    $request = $row['request'];
    check($request->getMethod() === $expected[$index]['method'], 'HTTP method changed');
    check((string) $request->getUri() === $expected[$index]['uri'], 'Payment destination or path escaping changed');
    check((string) $request->getBody() === $expected[$index]['body'], 'Serialized payment payload changed');
    $headers = $expected[$index]['headers'];
    // This is an application adapter now; do not claim to be the retired SDK.
    unset($headers['x-sdk-platform']);
    check($request->getHeaders() === $headers, 'Authentication, content or API version headers changed');
    check($row['options']['allow_redirects'] === false, 'Credentials must not follow redirects');
  }
  $suffixes = ['packages'=>'package_id', 'subscribe'=>'plan_id', 'wallet'=>null,
    'donate'=>'post_id', 'paid_post'=>'post_id', 'movies'=>'movie_id', 'marketplace'=>'orders_collection_id'];
  foreach ($suffixes as $handle => $key) {
    $client = offlineClient($system, [new Response(200, [], '{"payment_session_id":"fixture-session"}')], $history);
    check(cashfree($handle, 12.34, 42, 'Example', 'fixture@example.test', '0000000000', $client) === 'fixture-session', 'Payment helper changed its session result');
    check(count($history) === 1, 'Order creation must make exactly one request');
    $body = json_decode((string) $history[0]['request']->getBody(), true);
    check($body['order_amount'] === '12.34' && $body['order_currency'] === 'USD', 'Amount or currency changed');
    check($body['customer_details']['customer_email'] === 'fixture@example.test' && $body['customer_details']['customer_name'] === 'Example' && $body['customer_details']['customer_phone'] === '0000000000', 'Customer fields changed');
    check((bool) preg_match('/^[a-f0-9]{13}$/', $body['customer_details']['customer_id']), 'Customer identity generation changed');
    $url = 'https://example.test/webhooks/cashfree.php?orderId={order_id}&handle=' . $handle . ($key ? '&' . $key . '=42' : '');
    check($body['order_meta']['return_url'] === $url, 'Webhook handle or return URL changed');
  }
  check($_SESSION['wallet_replenish_amount'] === 12.34 && $_SESSION['donation_amount'] === 12.34, 'Session amount bookkeeping changed');
  foreach (['[]'=>false, '[{"payment_status":"SUCCESS"}]'=>true, '[{"payment_status":"PENDING"},{"payment_status":"SUCCESS"}]'=>false, '[{"payment_status":"FAILED"}]'=>false] as $body => $expected) {
    $client = offlineClient($system, [new Response(200, [], $body)], $history);
    check(cashfree_check('fixture-order', $client) === $expected, 'First-payment decision changed');
    check(count($history) === 1, 'Payment lookup must make exactly one request');
  }
}
// Both helpers must surface transport errors, bad responses and redirects, with no retries.
foreach (['create', 'check'] as $operation) {
  $responses = [new Response(401, [], '{"message":"fixture denied"}'), new Response(302, ['Location'=>'https://other.example.test']), new Response(200, [], 'invalid-json'), new GuzzleHttp\Exception\ConnectException('fixture unavailable', new Request('GET', 'https://example.test'))];
  foreach ($responses as $response) {
    $client = offlineClient($system, [$response], $history);
    $thrown = false;
    try {
      $operation === 'create' ? cashfree('wallet', 10, null, 'Example', 'fixture@example.test', '0000000000', $client) : cashfree_check('fixture-order', $client);
    } catch (\Exception $error) { $thrown = true; check($error->getMessage() !== '', 'Provider failure must remain observable'); }
    check($thrown, 'Provider failure was accepted');
    check(count($history) === 1, 'A failed payment operation must not be retried');
  }
}
$client = offlineClient($system, [new Response(200, [], '{}')], $history);
try { $client->createOrder(json_decode($wire[0]['body'], true)); throw new \LogicException('Expected missing-session failure'); }
catch (\UnexpectedValueException $error) { check($error->getMessage() === 'Cashfree returned no payment session', 'Missing session must fail'); }
// Original SDK setters rejected these inputs before creating an HTTP request.
$invalid = json_decode(file_get_contents(__DIR__ . '/fixtures/cashfree-validation.json'), true, 512, JSON_THROW_ON_ERROR);
foreach ($invalid as $case) {
  $order = json_decode($wire[0]['body'], true);
  $field = $case['field'];
  if (strpos($field, 'customer_') === 0) $order['customer_details'][$field] = $case['value'];
  elseif ($field === 'return_url') $order['order_meta'][$field] = $case['value'];
  else $order[$field] = $case['value'];
  $client = offlineClient($system, [new Response(200, [], '{"payment_session_id":"must-not-send"}')], $history);
  $message = null;
  try { $client->createOrder($order); } catch (\InvalidArgumentException $error) { $message = $error->getMessage(); }
  check($message === $case['message'], 'Original input rejection changed: ' . $field);
  check(count($history) === 0, 'Invalid order reached payment transport: ' . $field);
  // Exercise the actual entry point for each externally supplied field.
  if (in_array($field, ['customer_name', 'customer_email', 'customer_phone', 'order_currency'], true) || ($field === 'order_amount' && $case['value'] !== null)) {
    $input = ['customer_name'=>'Example', 'customer_email'=>'fixture@example.test', 'customer_phone'=>'0000000000', 'order_amount'=>12.34, 'order_currency'=>'USD'];
    $input[$field] = $case['value'];
    $settings = $system; $settings['system_currency'] = $input['order_currency'];
    $previousSystem = $system; $system = $settings;
    $client = offlineClient($settings, [new Response(200, [], '{"payment_session_id":"must-not-send"}')], $history);
    $message = null;
    try { cashfree('wallet', $input['order_amount'], null, $input['customer_name'], $input['customer_email'], $input['customer_phone'], $client); }
    catch (\Exception $error) { $message = $error->getMessage(); }
    finally { $system = $previousSystem; }
    check($message === $case['message'] && count($history) === 0, 'Invalid input escaped real payment helper: ' . $field);
  }
}
foreach ([3, 100] as $length) {
  $client = offlineClient($system, [new Response(200, [], '{"payment_session_id":"boundary-session"}')], $history);
  check(cashfree('wallet', 1, null, str_repeat('é', $length), str_repeat('x', $length), '0000000000', $client) === 'boundary-session', 'Valid inclusive field bounds changed');
  check(count($history) === 1, 'Valid boundary input must reach the provider once');
}
echo "PASS: original wire contracts, both payment entry points, all seven handles, first-payment decisions and failure boundaries\n";
