<?php
// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS
ini_set('session.gc_maxlifetime', 3600); // 1 hour
ini_set('session.cookie_path', '/'); // Allow cookies for entire domain

session_start();

// Include database configuration
include 'config.php';

// Mengatur header agar output berupa JSON
header('Content-Type: application/json; charset=utf-8');

// Cek koneksi (sudah di config.php)
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed'
    ]);
    exit;
}

// Cek apakah request method adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
    exit;
}

// Ambil data dari POST
$input_username = trim($_POST['username'] ?? '');
$input_password = $_POST['password'] ?? '';

// Debug logging
error_log("Login attempt - Username: $input_username");

// Validasi input
if (empty($input_username) || empty($input_password)) {
    error_log("Login failed - Empty credentials");
    echo json_encode([
        'success' => false,
        'message' => 'Username dan password harus diisi'
    ]);
    exit;
}

// Query untuk mencari user berdasarkan username
$sql = "SELECT id, username, password, email FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error'
    ]);
    exit;
}

$stmt->bind_param("s", $input_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    error_log("User found: " . $user['username']);

    // Verifikasi password
    if (password_verify($input_password, $user['password'])) {
        error_log("Password verified successfully for user: " . $user['username']);

        // Login berhasil - set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['logged_in'] = true;

        error_log("Session set successfully for user: " . $user['username']);

        echo json_encode([
            'success' => true,
            'message' => 'Login berhasil',
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email']
            ]
        ]);
    } else {
        error_log("Password verification failed for user: $input_username");
        // Password salah
        echo json_encode([
            'success' => false,
            'message' => 'Username atau password salah'
        ]);
    }
} else {
    error_log("User not found: $input_username");
    // Username tidak ditemukan
    echo json_encode([
        'success' => false,
        'message' => 'Username atau password salah'
    ]);
}

$stmt->close();
$conn->close();
?>