<?php
// Test koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "luka_plus_db";

header('Content-Type: application/json');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Connection failed: ' . $conn->connect_error
    ]);
} else {
    echo json_encode([
        'status' => 'success',
        'message' => 'Connected successfully'
    ]);
}

$conn->close();
?>