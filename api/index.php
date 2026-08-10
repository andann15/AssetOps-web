<?php

// Force error display for debugging
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$root = dirname(__DIR__);

// Set correct paths for Laravel
$_SERVER['SCRIPT_FILENAME'] = $root . '/public/index.php';
$_SERVER['SCRIPT_NAME']     = '/index.php';

// Catch ALL errors including fatal ones
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    echo "<b>PHP Error [$errno]:</b> $errstr in $errfile on line $errline<br>";
    return true;
});

register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        echo "<h1>FATAL ERROR</h1>";
        echo "<pre>" . print_r($error, true) . "</pre>";
    }
});

// Serve static assets directly if they exist in /public
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));
$file = $root . '/public' . $uri;

if ($uri !== '/' && is_file($file)) {
    return false;
}

try {
    // Bootstrap Laravel
    require $root . '/public/index.php';
} catch (\Throwable $e) {
    echo "<h1>Laravel Error</h1>";
    echo "<b>Message:</b> " . htmlspecialchars($e->getMessage()) . "<br>";
    echo "<b>File:</b> " . $e->getFile() . " line " . $e->getLine() . "<br>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
