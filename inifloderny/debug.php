<?php
// Comprehensive test for login system
session_start();

echo "<h1>🔍 Sistem Login Test</h1>";

// Test 1: Check PHP version and extensions
echo "<h2>1. PHP Environment</h2>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Session Status: " . (session_status() === PHP_SESSION_ACTIVE ? "Active" : "Inactive") . "</p>";

// Test 2: Check database connection
echo "<h2>2. Database Connection</h2>";
try {
    $conn = new mysqli("localhost", "root", "", "luka_plus_db");
    if ($conn->connect_error) {
        echo "<p style='color: red;'>❌ Database Error: " . $conn->connect_error . "</p>";
    } else {
        echo "<p style='color: green;'>✅ Database Connected Successfully</p>";

        // Check users table
        $result = $conn->query("SELECT COUNT(*) as count FROM users");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "<p>Users in database: " . $row['count'] . "</p>";
        }

        $conn->close();
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Database Exception: " . $e->getMessage() . "</p>";
}

// Test 3: Check file permissions
echo "<h2>3. File Permissions</h2>";
$files = ['login.html', 'login.css', 'login_process.php', 'auth_check.php'];
foreach ($files as $file) {
    $path = __DIR__ . '/' . $file;
    if (file_exists($path)) {
        echo "<p style='color: green;'>✅ $file exists</p>";
    } else {
        echo "<p style='color: red;'>❌ $file missing</p>";
    }
}

// Test 4: Session test
echo "<h2>4. Session Test</h2>";
$_SESSION['test'] = 'working';
if (isset($_SESSION['test'])) {
    echo "<p style='color: green;'>✅ Session working</p>";
    unset($_SESSION['test']);
} else {
    echo "<p style='color: red;'>❌ Session not working</p>";
}

echo "<h2>5. Quick Links</h2>";
echo "<p><a href='login.html'>Test Login Page</a></p>";
echo "<p><a href='index.php'>Test Index Redirect</a></p>";
echo "<p><a href='test_logout.php'>Test Logout Status</a></p>";
?>