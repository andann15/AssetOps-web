<?php

/**
 * Entry point for Vercel PHP runtime.
 * Bridges Vercel serverless functions to Laravel's public/index.php.
 */

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

// Set correct paths for Laravel
$_SERVER['SCRIPT_FILENAME'] = $root . '/public/index.php';
$_SERVER['SCRIPT_NAME']     = '/index.php';

// Serve static assets directly if they exist in /public
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));
$file = $root . '/public' . $uri;

if ($uri !== '/' && is_file($file)) {
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $mimeTypes = [
        'css' => 'text/css',
        'js'  => 'application/javascript',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'svg' => 'image/svg+xml',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ico' => 'image/x-icon',
    ];
    if (isset($mimeTypes[$ext])) {
        header('Content-Type: ' . $mimeTypes[$ext]);
    }
    header('Cache-Control: public, max-age=31536000');
    readfile($file);
    exit;
}

// Bootstrap Laravel
require $root . '/public/index.php';
