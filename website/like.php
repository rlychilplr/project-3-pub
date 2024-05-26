<?php
    include 'database-connect.php';

    session_start();

    $messageId = $_POST['message-id'];
    $userId = $_SESSION['user_id'];

    // Check if a like from this user to this message already exists
    $sql = "SELECT COUNT(*) as count FROM likes WHERE `message-id` = $messageId AND `user-id` = $userId";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) {
        // The user has not liked this message, so insert a new like
        $sql = "INSERT INTO likes (`message-id`, `user-id`) VALUES ($messageId, $userId)";
    } else {
        // The user has already liked this message, so delete the like
        $sql = "DELETE FROM likes WHERE `message-id` = $messageId AND `user-id` = $userId";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
?>