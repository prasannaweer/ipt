<?php
// Debug page - shows connection info
echo "<h1>Database Debug</h1>";

echo "<h3>Environment Variables:</h3>";
echo "<pre>";
echo "DB_HOST: " . var_export(getenv('DB_HOST'), true) . "\n";
echo "DB_USER: " . var_export(getenv('DB_USER'), true) . "\n";
echo "DB_PASS: " . (getenv('DB_PASS') ? '(set, hidden)' : '(empty)') . "\n";
echo "DB_NAME: " . var_export(getenv('DB_NAME'), true) . "\n";
echo "MYSQLHOST: " . var_export(getenv('MYSQLHOST'), true) . "\n";
echo "MYSQLUSER: " . var_export(getenv('MYSQLUSER'), true) . "\n";
echo "MYSQLPASSWORD: " . (getenv('MYSQLPASSWORD') ? '(set, hidden)' : '(empty)') . "\n";
echo "MYSQLDATABASE: " . var_export(getenv('MYSQLDATABASE'), true) . "\n";
echo "MYSQLPORT: " . var_export(getenv('MYSQLPORT'), true) . "\n";
echo "</pre>";

echo "<h3>PHP Extensions:</h3>";
echo "<pre>";
echo "mysqli: " . (extension_loaded('mysqli') ? 'YES' : 'NO') . "\n";
echo "pdo: " . (extension_loaded('pdo') ? 'YES' : 'NO') . "\n";
echo "pdo_mysql: " . (extension_loaded('pdo_mysql') ? 'YES' : 'NO') . "\n";
echo "PHP Version: " . phpversion() . "\n";
echo "</pre>";

echo "<h3>Connection Test:</h3>";
require_once 'db_config.php';
echo "<pre>";
echo "Status: Connected OK\n";
echo "Server: " . $conn->server_info . "\n";
echo "Host: " . $conn->host_info . "\n";
echo "</pre>";
?>
