<?php
// Simple login test without complex logic
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Simple hardcoded test (bypass database for now)
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = 'admin';
        echo json_encode(['success' => true, 'message' => 'Login berhasil']);
    } elseif ($username === 'binus' && $password === 'makangratis') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = 'binus';
        echo json_encode(['success' => true, 'message' => 'Login berhasil']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Username atau password salah']);
    }
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Login Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .form-group { margin: 10px 0; }
        input { padding: 8px; margin: 5px 0; }
        button { padding: 10px 20px; background: #28a745; color: white; border: none; cursor: pointer; }
        .result { margin: 20px 0; padding: 10px; border-radius: 4px; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <h1>Simple Login Test</h1>
    <form id="loginForm">
        <div class="form-group">
            <label>Username:</label><br>
            <input type="text" id="username" required>
        </div>
        <div class="form-group">
            <label>Password:</label><br>
            <input type="password" id="password" required>
        </div>
        <button type="submit">Login</button>
    </form>

    <div id="result"></div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const result = document.getElementById('result');

            result.innerHTML = 'Processing...';
            result.className = 'result';

            fetch('simple_login_test.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    result.innerHTML = 'SUCCESS: ' + data.message;
                    result.className = 'result success';
                    setTimeout(() => {
                        window.location.href = 'home.html';
                    }, 1000);
                } else {
                    result.innerHTML = 'ERROR: ' + data.message;
                    result.className = 'result error';
                }
            })
            .catch(error => {
                result.innerHTML = 'NETWORK ERROR: ' + error.message;
                result.className = 'result error';
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>