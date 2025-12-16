<?php
session_start();

echo "<h1>Test Logout Status</h1>";

// Cek status session
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    echo "<p style='color: green;'>✅ User sedang login sebagai: " . ($_SESSION['username'] ?? 'Unknown') . "</p>";
    echo "<p><a href='logout.php'>Logout Test</a></p>";
} else {
    echo "<p style='color: red;'>❌ User belum login</p>";
    echo "<p><a href='login.html'>Login</a></p>";
}

// Tampilkan semua session data untuk debugging
echo "<h2>Session Data:</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// Link untuk clear session manual
echo "<p><a href='?clear=1' style='color: red;'>Clear Session Manual</a></p>";

if (isset($_GET['clear'])) {
    session_destroy();
    header('Location: test_logout.php');
    exit;
}
?>