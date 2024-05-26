<?php
include 'database-connect.php';

session_start();

$messageId = intval($_POST['message-id']);
$currentUserId = intval($_SESSION['user_id']);

$sql = "DELETE FROM messages WHERE `message-id` = $messageId AND `user-id` = $currentUserId";
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully"; // this echo does nothing lol
} else {
    echo "Error deleting record: " . $conn->error;
}
