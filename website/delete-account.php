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
    // Check if the submitted form is for deleting account
    if (isset($_POST['psw'])) {
        // Handle account deletion request
        $password = $_POST['psw'];

        // Retrieve user's information from the database based on their session user ID
        $userId = $_SESSION["user_id"];

        // Query to fetch user's information
        $query = "SELECT `password`, `password-salt` FROM `user` WHERE `user-id` = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param("i", $userId);
        $statement->execute();
        $result = $statement->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Verify password
            if (password_verify($password . $user['password-salt'], $user['password'])) {
                // Delete the user account from the database
                $deleteQuery = "DELETE FROM `user` WHERE `user-id` = ?";
                $deleteStatement = $conn->prepare($deleteQuery);
                $deleteStatement->bind_param("i", $userId);

                if ($deleteStatement->execute()) {
                    // Account deleted successfully, destroy session and redirect to login page
                    session_destroy();
                    header('Refresh: 10; URL=index.php');
                    exit();
                } else {
                    echo "Failed to delete account.";
                }
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "User not found.";
        }
    } else {
        // The submitted form is missing required fields
        echo "Please enter your password.";
    }
}
?>
