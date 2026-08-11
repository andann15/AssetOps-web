<?php
// Minimal debug - no Laravel, no dependencies
// Access: https://your-vercel-url.vercel.app/api/debug.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: text/plain');

echo "PHP Version: " . PHP_VERSION . "\n";
echo "PHP Loaded Extensions:\n";
foreach (get_loaded_extensions() as $ext) {
    echo "  - $ext\n";
}

echo "\nEnvironment Variables:\n";
$safe_keys = ['APP_ENV', 'APP_DEBUG', 'APP_KEY', 'DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME'];
foreach ($safe_keys as $key) {
    $val = getenv($key) ?: ($_ENV[$key] ?? 'NOT SET');
    if ($key === 'APP_KEY' && strlen($val) > 10) {
        $val = substr($val, 0, 10) . '...(hidden)';
    }
    if ($key === 'DB_PASSWORD') {
        $val = '(hidden)';
    }
    echo "  $key = $val\n";
}

echo "\nWrite access to /tmp: " . (is_writable('/tmp') ? 'YES' : 'NO') . "\n";

$tmpDir = '/tmp/bootstrap/cache';
if (!is_dir($tmpDir)) {
    mkdir($tmpDir, 0775, true);
}
echo "Can create /tmp/bootstrap/cache: " . (is_dir($tmpDir) ? 'YES' : 'NO') . "\n";

echo "\nDone!";
