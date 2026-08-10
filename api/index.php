<?php

/**
 * Entry point for Vercel PHP runtime.
 * This file bridges Vercel serverless functions to Laravel's public/index.php.
 */

$root = dirname(__DIR__);

// Vercel filesystem is read-only except /tmp
// Create writable storage directories in /tmp
$storagePaths = [
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
    '/tmp/bootstrap/cache',
];

foreach ($storagePaths as $path) {
    if (!is_dir($path)) {
        mkdir($path, 0775, true);
    }
}

// Replace storage symlinks to point to /tmp
$storageDirs = [
    'framework/cache',
    'framework/cache/data',
    'framework/sessions',
    'framework/views',
    'framework/testing',
    'logs',
    'app',
    'app/public',
];

// Override storage path so Laravel writes to /tmp/storage
putenv('STORAGE_PATH=/tmp/storage');
$_ENV['STORAGE_PATH'] = '/tmp/storage';
$_SERVER['STORAGE_PATH'] = '/tmp/storage';

// Override bootstrap cache path
if (!is_dir('/tmp/bootstrap/cache')) {
    mkdir('/tmp/bootstrap/cache', 0775, true);
}

// Copy compiled bootstrap/cache to /tmp if exists
$bootstrapCache = $root . '/bootstrap/cache';
if (is_dir($bootstrapCache)) {
    foreach (glob($bootstrapCache . '/*.php') as $file) {
        $dest = '/tmp/bootstrap/cache/' . basename($file);
        if (!file_exists($dest)) {
            copy($file, $dest);
        }
    }
}

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
