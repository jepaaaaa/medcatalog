<?php
// Test database connection
$conn = new mysqli('localhost', 'root', '', 'luka_plus_db');

if ($conn->connect_error) {
    echo 'Connection failed: ' . $conn->connect_error . PHP_EOL;
    exit(1);
} else {
    echo 'Database connected successfully' . PHP_EOL;
}

$result = $conn->query('SELECT COUNT(*) as count FROM users');
if ($result) {
    $row = $result->fetch_assoc();
    echo 'Users in database: ' . $row['count'] . PHP_EOL;

    // Show users
    $users = $conn->query('SELECT id, username, email FROM users');
    if ($users) {
        echo PHP_EOL . 'User list:' . PHP_EOL;
        while ($user = $users->fetch_assoc()) {
            echo '- ' . $user['username'] . ' (' . $user['email'] . ')' . PHP_EOL;
        }
    }
} else {
    echo 'Query failed: ' . $conn->error . PHP_EOL;
}

$conn->close();
?>