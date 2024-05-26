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
    // Check if the submitted form is for changing display name
    if (isset($_POST['nd']) && isset($_POST['psw'])) {
        // Handle display name change request
        $newDisplayname = $_POST['nd'];
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
                // Update the display name in the database
                $updateQuery = "UPDATE `user` SET `displayname` = ? WHERE `user-id` = ?";
                $updateStatement = $conn->prepare($updateQuery);
                $updateStatement->bind_param("si", $newDisplayname, $userId);

                if ($updateStatement->execute()) {
                    $_SESSION['displayname'] = $newDisplayname;
                    echo "Display name changed successfully! <br> Click <a href=\"index.php\">here</a> to go back.";
                    header('Refresh: 10; URL=index.php');
                } else {
                    echo "Failed to update display name.";
                }
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "User not found.";
        }
    } else {
        // The submitted form is for logging in
        // This part of the code should not be reachable since the display name change form should only be displayed when the user is logged in.
        // If the display name change form is displayed without the user being logged in, it could indicate a security issue.
    }
}
