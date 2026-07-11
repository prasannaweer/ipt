<?php
// Database Configuration for MIT IPT
// Works on both WAMP (local) and Railway (cloud)

// Railway sets DB_HOST, DB_USER, DB_PASS, DB_NAME as environment variables
// WAMP uses these defaults
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'mit_ipt');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
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