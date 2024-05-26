<?php
require "database-connect.php";

// Fetch the search term from the frontend
$searchTerm = $_GET['searchTerm'];

// SQL query to search for messages containing the search term
$sql = "SELECT messages.*, user.username, user.displayname, COUNT(likes.`like-id`) AS like_count
        FROM messages
        LEFT JOIN user ON messages.`user-id` = user.`user-id`
        LEFT JOIN likes ON messages.`message-id` = likes.`message-id`
        WHERE messages.content LIKE '%$searchTerm%'
        GROUP BY messages.`message-id`";
$result = $conn->query($sql);

// Check if any results were found
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<hr>";
        echo $row["username"] . " @" . $row["displayname"] . "<br>";
        echo "Content: " . $row["content"] . "<br>";
        echo "Like Count: " . $row["like_count"] . "<br>";
        echo "Timestamp: " . $row["timestamp"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
