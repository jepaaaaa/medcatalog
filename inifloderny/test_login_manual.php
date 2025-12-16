<?php
// Test login API
session_start();

$test_username = 'admin';
$test_password = 'admin123';

// Simulate login process
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "luka_plus_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h1>🔐 Login API Test</h1>";

// Test query
$sql = "SELECT id, username, password, email FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $test_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    echo "<p>✅ User found: " . $user['username'] . "</p>";

    // Test password verification
    if (password_verify($test_password, $user['password'])) {
        echo "<p>✅ Password correct</p>";

        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['logged_in'] = true;

        echo "<p>✅ Session set successfully</p>";
        echo "<p>Session ID: " . session_id() . "</p>";
        echo "<p><a href='home.html'>Go to Home</a></p>";
    } else {
        echo "<p>❌ Password incorrect</p>";
    }
} else {
    echo "<p>❌ User not found</p>";
}

$stmt->close();
$conn->close();

echo "<p><a href='login.html'>Back to Login</a></p>";
?>