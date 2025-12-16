<?php
// Script untuk menambahkan user demo baru
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "luka_plus_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// User demo baru
$demo_username = "binus";
$demo_password = password_hash("makangratis", PASSWORD_DEFAULT);
$demo_email = "demo@binus.ac.id";

$sql = "INSERT IGNORE INTO users (username, password, email) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $demo_username, $demo_password, $demo_email);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "✅ User demo berhasil ditambahkan!\n";
        echo "Username: binus\n";
        echo "Password: makangratis\n";
        echo "Email: demo@binus.ac.id\n";
    } else {
        echo "ℹ️ User demo sudah ada di database.\n";
    }
} else {
    echo "❌ Error menambahkan user demo: " . $stmt->error . "\n";
}

$stmt->close();
$conn->close();

echo "\n🎯 Akun demo siap digunakan!\n";
?>