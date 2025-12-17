<?php
// Include database configuration
include 'config.php';

// Mengatur header agar output berupa JSON
header('Content-Type: application/json; charset=utf-8');

// Cek koneksi
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Connection failed: ' . $conn->connect_error,
        'products' => []
    ]);
    exit;
}

// Query untuk mengambil semua produk
$sql = "SELECT id, name, description, REPLACE(image_url, 'images/', 'assets/images/') as image_url, price FROM products LIMIT 10";
$result = $conn->query($sql);

$products = [];

if ($result === false) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Query failed: ' . $conn->error,
        'products' => []
    ]);
    $conn->close();
    exit;
}

if ($result->num_rows > 0) {
    // Mengambil setiap baris data dan memasukkannya ke dalam array $products
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Menutup koneksi database
$conn->close();

// Mengubah array PHP menjadi format JSON dan menampilkannya
echo json_encode([
    'products' => $products
]);
?>