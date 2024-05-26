<?php

require "database-connect.php";

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['chanses'])) {
    // Sanitize input
    $text = mysqli_real_escape_string($conn, $_POST['chanses']); // dankjewel voor deze mooie naam chaymae

    // Insert message into the database
    session_start(); // Start the session if it's not already started
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; // Get the user ID from the session
    if ($userId) {
        $sql = "INSERT INTO messages (content, `user-id`) VALUES ('$text', '$userId')"; // Use the user ID from the session
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<p>User not logged in.</p>";
        echo "<p>go&nbsp;<a href='index.php'>back</a></p>";
    }
}

$conn->close();