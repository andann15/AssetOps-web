<?php

/**
 * Entry point for Vercel PHP runtime.
 * Bridges Vercel serverless functions to Laravel's public/index.php.
 */

$root = dirname(__DIR__);

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
