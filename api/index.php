<?php

/**
 * Entry point for Vercel PHP runtime.
 * This file bridges Vercel serverless functions to Laravel's public/index.php.
 */

$root = dirname(__DIR__);

// Vercel is read-only except for /tmp - symlink storage to /tmp
$storagePath = $root . '/storage';
$tmpStorage = '/tmp/storage';

if (!is_dir($tmpStorage)) {
    $dirs = [
        '/tmp/storage',
        '/tmp/storage/app',
        '/tmp/storage/app/public',
        '/tmp/storage/framework',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/testing',
        '/tmp/storage/framework/views',
        '/tmp/storage/logs',
    ];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
    }

    // Copy views if needed
    if (is_dir($storagePath . '/framework/views')) {
        foreach (glob($storagePath . '/framework/views/*') as $file) {
            copy($file, $tmpStorage . '/framework/views/' . basename($file));
        }
    }
}

// Redirect storage writes to /tmp
if (!is_link($storagePath . '/framework/cache')) {
    // We can't symlink on Vercel, set env vars instead
}

// Tell Laravel to use /tmp for writable storage
$_ENV['APP_STORAGE'] = $tmpStorage;

// Set correct paths for Laravel
$_SERVER['SCRIPT_FILENAME'] = $root . '/public/index.php';
$_SERVER['SCRIPT_NAME']     = '/index.php';

// Serve static assets directly if they exist in /public
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));
$file = $root . '/public' . $uri;

if ($uri !== '/' && is_file($file)) {
    return false; // Serve the file as-is
}

// Bootstrap Laravel
require $root . '/public/index.php';
