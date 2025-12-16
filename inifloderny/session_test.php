<?php
// Session configuration for better reliability
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS
ini_set('session.gc_maxlifetime', 3600); // 1 hour

session_start();

// Test session
$_SESSION['test_session'] = 'working_' . time();

echo "<h1>Session Test</h1>";
echo "<p>Session ID: " . session_id() . "</p>";
echo "<p>Session Status: " . (session_status() === PHP_SESSION_ACTIVE ? "Active" : "Inactive") . "</p>";
echo "<p>Test Value: " . ($_SESSION['test_session'] ?? 'Not set') . "</p>";

// Test database
$conn = new mysqli("localhost", "root", "", "luka_plus_db");
if ($conn->connect_error) {
    echo "<p style='color: red;'>DB Error: " . $conn->connect_error . "</p>";
} else {
    echo "<p style='color: green;'>DB Connected</p>";
    $conn->close();
}

echo "<p><a href='login.html'>Go to Login</a></p>";
echo "<p><a href='home.html'>Try Home (should redirect to login)</a></p>";
?>