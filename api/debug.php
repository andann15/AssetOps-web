<?php
// Debug file - DELETE AFTER TESTING
echo "<h1>PHP is working!</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Time: " . date('Y-m-d H:i:s') . "</p>";

$root = dirname(__DIR__);
echo "<p>Root path: " . $root . "</p>";
echo "<p>Vendor exists: " . (is_dir($root . '/vendor') ? 'YES' : 'NO') . "</p>";
echo "<p>Bootstrap/app.php exists: " . (file_exists($root . '/bootstrap/app.php') ? 'YES' : 'NO') . "</p>";
echo "<p>/tmp writable: " . (is_writable('/tmp') ? 'YES' : 'NO') . "</p>";

// Check env vars
echo "<h2>Key ENV Variables:</h2>";
echo "<p>APP_KEY set: " . (getenv('APP_KEY') ? 'YES' : 'NO') . "</p>";
echo "<p>DB_HOST: " . (getenv('DB_HOST') ?: 'NOT SET') . "</p>";
echo "<p>APP_ENV: " . (getenv('APP_ENV') ?: 'NOT SET') . "</p>";
