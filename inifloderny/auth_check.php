<?php
session_start();

// Debug logging
error_log("Auth check - Session ID: " . session_id());
error_log("Auth check - logged_in: " . (isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : 'not set'));
error_log("Auth check - username: " . ($_SESSION['username'] ?? 'not set'));

// Cek apakah user sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    error_log("Auth check - User not logged in, redirecting to login");
    header('Location: login.html');
    exit;
}

error_log("Auth check - User authenticated successfully");
?>