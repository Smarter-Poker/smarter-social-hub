<?php
// Validate the installed SDK option with real SDK calls and an offline transport.
require dirname(__DIR__) . '/vendor/autoload.php';
use Cashfree\Cashfree;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

// The pinned SDK's optional test transport parameter uses a relative namespace.
// Alias only in this offline fixture; production always uses its normal client.
class_alias(Client::class, 'Cashfree\\GuzzleHttp\\Client');

Cashfree::$XClientId = 'test-only';
Cashfree::$XClientSecret = 'test-only';
Cashfree::$XEnableErrorAnalytics = false;
$http = new Client(['handler' => HandlerStack::create(new MockHandler([
  new Response(200, ['Content-Type' => 'application/json'], '{"payment_session_id":"offline-session"}'),
  new Response(200, ['Content-Type' => 'application/json'], '[{"payment_status":"SUCCESS"}]'),
]))]);
$client = new Cashfree();
$customer = new \Cashfree\Model\CustomerDetails(['customer_id'=>'test', 'customer_phone'=>'0000000000']);
$request = new \Cashfree\Model\CreateOrderRequest(['order_amount'=>10, 'order_currency'=>'USD', 'customer_details'=>$customer]);
$order = $client->PGCreateOrder('2023-08-01', $request, null, null, $http);
$payments = $client->PGOrderFetchPayments('2023-08-01', 'test-order', null, null, $http);
if ($order[0]->getPaymentSessionId() !== 'offline-session' || $payments[0][0]->getPaymentStatus() !== 'SUCCESS') {
  throw new Exception('SDK response contract changed');
}
if (\Sentry\SentrySdk::getCurrentHub()->getClient() !== null) {
  throw new Exception('External analytics was initialized');
}
echo "PASS: real payment SDK processed both offline responses without initializing external analytics\n";
