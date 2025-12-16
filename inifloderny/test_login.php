<?php
// Test login functionality
session_start();

// Test koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "luka_plus_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "✅ Database connection successful<br>";

// Test query users
$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "✅ Users found in database:<br>";
    while($row = $result->fetch_assoc()) {
        echo "- ID: " . $row["id"] . ", Username: " . $row["username"] . ", Email: " . $row["email"] . "<br>";
    }
} else {
    echo "❌ No users found in database<br>";
}

$conn->close();

echo "<br>🔐 Test login credentials:<br>";
echo "<strong>Akun Demo 1:</strong><br>";
echo "Username: admin<br>";
echo "Password: admin123<br><br>";
echo "<strong>Akun Demo 2:</strong><br>";
echo "Username: binus<br>";
echo "Password: makangratis<br><br>";
echo "<a href='login.html'>Go to Login Page</a>";
?>