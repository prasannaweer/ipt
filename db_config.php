<?php
// Database Configuration for MIT IPT
// Works on both WAMP (local) and Railway (cloud)

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Railway sets these env vars automatically when you add MySQL
// WAMP uses the defaults below
$dbHost = getenv('DB_HOST') ?: getenv('MYSQLHOST') ?: 'localhost';
$dbUser = getenv('DB_USER') ?: getenv('MYSQLUSER') ?: 'root';
$dbPass = getenv('DB_PASS') ?: getenv('MYSQLPASSWORD') ?: '';
$dbName = getenv('DB_NAME') ?: getenv('MYSQLDATABASE') ?: 'mit_ipt';

// Create connection
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// If database doesn't exist, try creating it
if ($conn->connect_error) {
    // Try connecting without database name to create it
    $conn2 = @new mysqli($dbHost, $dbUser, $dbPass);
    if (!$conn2->connect_error) {
        $conn2->query("CREATE DATABASE IF NOT EXISTS `" . $dbName . "`");
        $conn2->close();
        // Retry connection
        $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    }
}

// Final check
if ($conn->connect_error) {
    http_response_code(500);
    die("<h1>Database Connection Failed</h1><pre>" . htmlspecialchars($conn->connect_error) . "</pre>");
}

// Set charset
$conn->set_charset("utf8mb4");

// Helper function for JSON responses
function jsonResponse($data, $code = 200) {
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

// Helper function for sanitize input
function sanitize($conn, $input) {
    return $conn->real_escape_string(htmlspecialchars(trim($input)));
}

// Helper: Calculate grade from average
function calculateGrade($average) {
    if ($average >= 80) return 'A';
    if ($average >= 70) return 'B';
    if ($average >= 60) return 'C';
    if ($average >= 50) return 'D';
    if ($average >= 40) return 'E';
    return 'F';
}
?>
