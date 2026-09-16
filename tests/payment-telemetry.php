<?php
// Exercise the real payment entry points with a no-network payment-client double.
namespace Cashfree {
  class Cashfree {
    public static $XEnableErrorAnalytics = true;
    public static $XClientId, $XClientSecret, $XEnvironment;
    public static $SANDBOX = 0, $PRODUCTION = 1;
    public static $status = 'SUCCESS';
    public static $fail = false;
    public function PGCreateOrder($version, $request) {
      if (self::$XEnableErrorAnalytics) throw new \Exception('External analytics was enabled');
      if (self::$fail) throw new \Exception('Payment provider unavailable');
      if ($request->getOrderAmount() != 10) throw new \Exception('Payment amount changed');
      return [new class { function getPaymentSessionId() { return 'test-session'; } }];
    }
    public function PGOrderFetchPayments(...$args) {
      if (self::$XEnableErrorAnalytics) throw new \Exception('External analytics was enabled');
      if (self::$fail) throw new \Exception('Payment provider unavailable');
      return [[new class { function getPaymentStatus() { return Cashfree::$status; } }]];
    }
  }
}
namespace {
  require dirname(__DIR__) . '/vendor/autoload.php';
  require (getenv('PAYMENT_SOURCE_ROOT') ?: dirname(__DIR__)) . '/includes/functions.php';
  function check($ok, $message) { if (!$ok) throw new \Exception($message); }
  $system = ['system_url' => 'https://example.test', 'system_currency' => 'USD',
    'cashfree_client_id' => 'test-only', 'cashfree_client_secret' => 'test-only',
    'cashfree_mode' => 'sandbox', 'payment_vat_enabled' => false, 'payment_fees_enabled' => false];
  foreach (['sandbox', 'production'] as $mode) {
    $system['cashfree_mode'] = $mode;
    \Cashfree\Cashfree::$XEnableErrorAnalytics = true;
    check(cashfree('wallet', 10, null, 'Test', 'test@example.test', '0000000000') === 'test-session', 'Session result changed');
    check($_SESSION['wallet_replenish_amount'] === 10, 'Wallet amount changed');
    \Cashfree\Cashfree::$XEnableErrorAnalytics = true;
    check(cashfree_check('test-order') === true, 'Successful payment changed');
    \Cashfree\Cashfree::$status = 'PENDING';
    check(cashfree_check('test-order') === false, 'Pending payment must not be successful');
    \Cashfree\Cashfree::$status = 'SUCCESS';
  }
  \Cashfree\Cashfree::$fail = true;
  foreach ([fn() => cashfree_check('test-order'), fn() => cashfree('wallet', 10, null, 'Test', 'test@example.test', '0000000000')] as $invoke) {
    try { $invoke(); throw new \Exception('Expected provider failure'); }
    catch (\Exception $e) { check($e->getMessage() === 'Payment provider unavailable', 'Original provider error must propagate'); }
  }
  echo "PASS: both payment entry points disable optional analytics, preserve results and propagate failures\n";
}
