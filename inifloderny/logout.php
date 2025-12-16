<?php
session_start();

// Hapus semua session data
$_SESSION = array();

// Hapus session cookie jika ada
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Destroy session
session_destroy();

// Start session baru untuk flash message
session_start();
$_SESSION['logout_message'] = 'Anda telah berhasil logout.';

// Redirect ke halaman login
header('Location: login.html');
exit;
?>