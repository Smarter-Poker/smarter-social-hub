<?php
// Deny restoration of the retired provider and the payment SDK that embedded it.
$root = getenv('PAYMENT_SOURCE_ROOT') ?: dirname(__DIR__);
$retiredProvider = implode('', ['sen', 'try']);
$forbiddenPackages = [$retiredProvider . '/sdk', $retiredProvider . '/' . $retiredProvider, 'cashfree/cashfree-pg'];
$lock = json_decode(file_get_contents($root . '/composer.lock'), true, 512, JSON_THROW_ON_ERROR);
foreach ($lock['packages'] as $package) {
  if (in_array($package['name'], $forbiddenPackages, true)) throw new RuntimeException('Retired SDK remains in the lock graph');
}
foreach ($forbiddenPackages as $package) {
  if (is_dir($root . '/vendor/' . $package)) throw new RuntimeException('Retired SDK remains installed');
}
foreach (['includes/functions.php', 'includes/cashfree-client.php', 'vendor/composer/autoload_files.php', 'vendor/composer/autoload_psr4.php', 'vendor/composer/autoload_static.php', 'vendor/composer/installed.json', 'vendor/composer/installed.php'] as $file) {
  $source = file_get_contents($root . '/' . $file);
  if (preg_match('/\b' . preg_quote($retiredProvider, '/') . '(?:\\\\|\/|\.|_)/i', $source) || strpos($source, 'Cashfree\\Cashfree') !== false) {
    throw new RuntimeException('Retired provider wiring remains in ' . $file);
  }
}
// Validate generated maps too: removing package bytes must not leave dead paths.
foreach (['autoload_files.php', 'autoload_classmap.php', 'autoload_psr4.php', 'autoload_namespaces.php'] as $map) {
  foreach (require $root . '/vendor/composer/' . $map as $name => $paths) {
    foreach ((array) $paths as $path) {
      if (!file_exists($path)) throw new RuntimeException('Missing autoload target: ' . $map . ' ' . $name);
    }
  }
}
$installedRuntime = require $root . '/vendor/composer/installed.php';
foreach ($installedRuntime['versions'] as $name => $record) {
  if (isset($record['install_path']) && !is_dir($record['install_path'])) throw new RuntimeException('Installed runtime path missing: ' . $name);
}
$installed = json_decode(file_get_contents($root . '/vendor/composer/installed.json'), true, 512, JSON_THROW_ON_ERROR);
$lockedNames = array_column($lock['packages'], 'name');
$installedNames = array_column($installed['packages'], 'name');
sort($lockedNames); sort($installedNames);
if ($lockedNames !== $installedNames) throw new RuntimeException('Lock and installed package inventory differ');
require $root . '/vendor/autoload.php';
if (class_exists(ucfirst($retiredProvider) . '\\' . ucfirst($retiredProvider) . 'Sdk') || class_exists('Cashfree\\Cashfree')) throw new RuntimeException('Retired SDK still autoloads');
if (!class_exists(GuzzleHttp\Client::class)) throw new RuntimeException('Payment HTTP client no longer autoloads');
echo "PASS: retired SDKs absent from dependencies, installation, application wiring and autoload\n";
