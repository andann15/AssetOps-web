<?php

// Force error display for debugging
ini_set('display_errors', '1');
error_reporting(E_ALL);

$root = dirname(__DIR__);

// Set Laravel to use /tmp for all auto-generated cache files
$tmpBootstrapCache = '/tmp/bootstrap/cache';
$_ENV['APP_SERVICES_CACHE'] = $tmpBootstrapCache . '/services.php';
$_ENV['APP_PACKAGES_CACHE'] = $tmpBootstrapCache . '/packages.php';
$_ENV['APP_CONFIG_CACHE'] = $tmpBootstrapCache . '/config.php';
$_ENV['APP_ROUTES_CACHE'] = $tmpBootstrapCache . '/routes.php';
$_ENV['APP_EVENTS_CACHE'] = $tmpBootstrapCache . '/events.php';
putenv('APP_SERVICES_CACHE=' . $_ENV['APP_SERVICES_CACHE']);
putenv('APP_PACKAGES_CACHE=' . $_ENV['APP_PACKAGES_CACHE']);
putenv('APP_CONFIG_CACHE=' . $_ENV['APP_CONFIG_CACHE']);
putenv('APP_ROUTES_CACHE=' . $_ENV['APP_ROUTES_CACHE']);
putenv('APP_EVENTS_CACHE=' . $_ENV['APP_EVENTS_CACHE']);

if (!is_dir($tmpBootstrapCache)) {
    mkdir($tmpBootstrapCache, 0775, true);
}

$_SERVER['SCRIPT_FILENAME'] = $root . '/public/index.php';
$_SERVER['SCRIPT_NAME']     = '/index.php';

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));
$file = $root . '/public' . $uri;

if ($uri !== '/' && is_file($file)) {
    return false;
}

// Check what might fail BEFORE loading Laravel
echo "<!-- DEBUG START -->\n";

// 1. Check storage paths
$storageBase = $root . '/storage';
echo "<!-- storage writable: " . (is_writable($storageBase) ? 'YES' : 'NO') . " -->\n";
echo "<!-- storage/logs writable: " . (is_writable($storageBase.'/logs') ? 'YES' : 'NO') . " -->\n";
echo "<!-- storage/framework/views writable: " . (is_writable($storageBase.'/framework/views') ? 'YES' : 'NO') . " -->\n";
echo "<!-- storage/framework/sessions writable: " . (is_writable($storageBase.'/framework/sessions') ? 'YES' : 'NO') . " -->\n";
echo "<!-- /tmp writable: " . (is_writable('/tmp') ? 'YES' : 'NO') . " -->\n";

// 2. Check bootstrap/cache
echo "<!-- bootstrap/cache writable: " . (is_writable($root.'/bootstrap/cache') ? 'YES' : 'NO') . " -->\n";
echo "<!-- bootstrap/cache/packages.php exists: " . (file_exists($root.'/bootstrap/cache/packages.php') ? 'YES' : 'NO') . " -->\n";
echo "<!-- bootstrap/cache/services.php exists: " . (file_exists($root.'/bootstrap/cache/services.php') ? 'YES' : 'NO') . " -->\n";

// 3. Check APP_KEY
echo "<!-- APP_KEY set: " . (getenv('APP_KEY') ? 'YES ('.substr(getenv('APP_KEY'),0,10).'...)' : 'NO') . " -->\n";
echo "<!-- DB_HOST: " . (getenv('DB_HOST') ?: 'NOT SET') . " -->\n";
echo "<!-- SESSION_DRIVER: " . (getenv('SESSION_DRIVER') ?: 'NOT SET') . " -->\n";

ob_start();
try {
    // Bootstrap Laravel
    require $root . '/public/index.php';
} catch (\Throwable $e) {
    ob_end_clean();
    echo "<h1>ORIGINAL Error: " . get_class($e) . "</h1>";
    echo "<b>Message:</b> " . htmlspecialchars($e->getMessage()) . "<br><br>";
    echo "<b>File:</b> " . $e->getFile() . " line " . $e->getLine() . "<br><br>";
    
    echo "<h2>Laravel Log File (/tmp/storage/logs/laravel.log):</h2>";
    $logFile = '/tmp/storage/logs/laravel.log';
    if (file_exists($logFile)) {
        echo "<pre style='background:#333;color:#fff;padding:10px;overflow:auto;max-height:500px;'>";
        echo htmlspecialchars(file_get_contents($logFile));
        echo "</pre>";
    } else {
        echo "<p>Log file does not exist.</p>";
    }
}
ob_end_flush();
