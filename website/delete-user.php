<?php
session_start();

if ($_SESSION['admin'] !== 1) {
    die('Unauthorized access');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userIdToDelete = $_POST['user_id'];

    // Include database connection
    require 'database-connect.php';

    $stmt = $conn->prepare('DELETE FROM user WHERE `user-id` = ?');
    $stmt->bind_param('i', $userIdToDelete);

    if ($stmt->execute()) {
        echo 'User deleted successfully';
    } else {
        echo 'Error deleting user: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}