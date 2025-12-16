<?php
// Script untuk membuat tabel users dan insert data default
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "luka_plus_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Buat tabel users jika belum ada
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabel users berhasil dibuat atau sudah ada.\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

// Insert user default jika belum ada
$default_username = "admin";
$default_password = password_hash("admin123", PASSWORD_DEFAULT);
$default_email = "admin@medcatalog.com";

$sql = "INSERT IGNORE INTO users (username, password, email) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $default_username, $default_password, $default_email);

if ($stmt->execute()) {
    echo "User default berhasil ditambahkan (username: admin, password: admin123).\n";
} else {
    echo "Error inserting user: " . $stmt->error . "\n";
}

$stmt->close();
$conn->close();

echo "Setup selesai! Silakan akses login.html untuk masuk.";
?>