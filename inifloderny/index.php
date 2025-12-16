<?php
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Jika sudah login, redirect ke home
    header('Location: home.html');
    exit;
} else {
    // Jika belum login, redirect ke login
    header('Location: login.html');
    exit;
}
?>