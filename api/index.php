<?php

// Force error display for debugging
ini_set('display_errors', '1');
error_reporting(E_ALL);

$root = dirname(__DIR__);

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
    require $root . '/public/index.php';
} catch (\Throwable $e) {
    ob_end_clean();
    echo "<h1>ORIGINAL Error: " . get_class($e) . "</h1>";
    echo "<b>Message:</b> " . htmlspecialchars($e->getMessage()) . "<br><br>";
    echo "<b>File:</b> " . $e->getFile() . " line " . $e->getLine() . "<br><br>";
    $prev = $e->getPrevious();
    if ($prev) {
        echo "<h2>Previous Exception:</h2>";
        echo "<b>Message:</b> " . htmlspecialchars($prev->getMessage()) . "<br>";
        echo "<b>File:</b> " . $prev->getFile() . " line " . $prev->getLine() . "<br>";
    }
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
ob_end_flush();
