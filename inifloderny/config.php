<?php
// Database configuration for Railway deployment
$servername = getenv('MYSQLHOST') ?: getenv('DB_HOST') ?: "localhost";
$username = getenv('MYSQLUSER') ?: getenv('DB_USER') ?: "root";
$password = getenv('MYSQLPASSWORD') ?: getenv('DB_PASSWORD') ?: "";
$dbname = getenv('MYSQLDATABASE') ?: getenv('DB_NAME') ?: "luka_plus_db";
$port = getenv('MYSQLPORT') ?: getenv('DB_PORT') ?: 3306;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>