<?php
// Include database connection
require "database-connect.php";

session_start(); // Start session to manage user login state

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header('Location: login.php');
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the submitted form is for changing username
    if (isset($_POST['nu']) && isset($_POST['psw'])) {
        // Handle username change request
        $newUsername = $_POST['nu'];
        $password = $_POST['psw'];

        // Retrieve user's information from the database based on their session user ID
        $userId = $_SESSION["user_id"];

        // Query to fetch user's information
        $query = "SELECT * FROM `user` WHERE `user-id` = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param("i", $userId);
        $statement->execute();
        $result = $statement->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Verify password
            if (password_verify($password . $user['password-salt'], $user['password'])) {
                // Update the username in the database
                $updateQuery = "UPDATE `user` SET `username` = ? WHERE `user-id` = ?";
                $updateStatement = $conn->prepare($updateQuery);
                $updateStatement->bind_param("si", $newUsername, $userId);

                if ($updateStatement->execute()) {
                    $_SESSION['username'] = $newUsername;
                    echo "Username changed successfully! <br> Click <a href=\"index.php\">here</a> to go back.";
                    header('Refresh: 10; URL=index.php');
                } else {
                    echo "Failed to update username.";
                }
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "User not found.";
        }
    } else {
        // The submitted form is for logging in
        // This part of the code should not be reachable since the username change form should only be displayed when the user is logged in.
        // If the username change form is displayed without the user being logged in, it could indicate a security issue.
    }
}
