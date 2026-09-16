<?php
/**
 * The two Cashfree Payments operations used by this application.
 * Keeps the existing API version and payment contract without an analytics SDK.
 */
final class CashfreePaymentClient
{
  private $http;
  private $baseUrl;
  private $headers;

  public function __construct(array $settings, ?\GuzzleHttp\ClientInterface $http = null)
  {
    $this->http = $http ?? new \GuzzleHttp\Client();
    $this->baseUrl = $settings['cashfree_mode'] == 'sandbox'
      ? 'https://sandbox.cashfree.com/pg' : 'https://api.cashfree.com/pg';
    $this->headers = [
      'Accept' => 'application/json',
      'Content-Type' => 'application/json',
      'x-client-secret' => $settings['cashfree_client_secret'],
      'x-client-id' => $settings['cashfree_client_id'],
      'x-api-version' => '2023-08-01',
    ];
  }

  public function createOrder(array $order): string
  {
    $result = $this->request('POST', '/orders', \GuzzleHttp\Utils::jsonEncode($order));
    if (!is_array($result) || !isset($result['payment_session_id']) || !is_string($result['payment_session_id']) || $result['payment_session_id'] === '') {
      throw new \UnexpectedValueException('Cashfree returned no payment session');
    }
    return $result['payment_session_id'];
  }

  public function firstPaymentSucceeded($orderId): bool
  {
    if ($orderId === null || (is_array($orderId) && count($orderId) === 0)) {
      throw new \InvalidArgumentException('Missing the required parameter $order_id when calling pGOrderFetchPayments');
    }
    $payments = $this->request('GET', '/orders/' . rawurlencode((string) $orderId) . '/payments');
    if (!is_array($payments) || array_values($payments) !== $payments) {
      throw new \UnexpectedValueException('Cashfree returned an invalid payment list');
    }
    // Preserve the existing first-payment-only decision used by the webhook.
    return isset($payments[0]['payment_status']) && $payments[0]['payment_status'] === 'SUCCESS';
  }

  private function request(string $method, string $path, string $body = '')
  {
    $request = new \GuzzleHttp\Psr7\Request($method, $this->baseUrl . $path, $this->headers, $body);
    try {
      // Do not retry a payment mutation or forward credentials through a redirect.
      $response = $this->http->send($request, ['allow_redirects' => false]);
    } catch (\GuzzleHttp\Exception\RequestException $error) {
      throw new \RuntimeException("[{$error->getCode()}] {$error->getMessage()}", (int) $error->getCode(), $error);
    } catch (\GuzzleHttp\Exception\ConnectException $error) {
      throw new \RuntimeException("[{$error->getCode()}] {$error->getMessage()}", (int) $error->getCode(), $error);
    }
    $status = $response->getStatusCode();
    if ($status < 200 || $status > 299) {
      throw new \RuntimeException(sprintf('[%d] Error connecting to the API (%s)', $status, (string) $request->getUri()), $status);
    }
    // Malformed provider responses must never appear as a successful payment.
    return \GuzzleHttp\Utils::jsonDecode((string) $response->getBody(), true);
  }
}
