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
    // Check if the submitted form is for changing password
    if (isset($_POST['op'], $_POST['np'], $_POST['cnp'])) {
        // Handle password change request
        $oldPassword = $_POST['op'];
        $newPassword = $_POST['np'];
        $confirmNewPassword = $_POST['cnp'];

        // Retrieve user's information from the database based on their session user ID
        $userId = $_SESSION["user_id"];

        // Query to fetch user's information
        $query = "SELECT `password`, `password-salt` FROM `user` WHERE `user-id` = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param("i", $userId);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify old password
            if (validatePassword($oldPassword, $user['password'], $user['password-salt'])) {
                // Check if new password and confirm new password match
                if ($newPassword === $confirmNewPassword) {
                    // Hash the new password
                    list($newPasswordHash, $newPasswordSalt) = saltAndHash($newPassword);

                    // Update the password and salt in the database
                    $updateQuery = "UPDATE `user` SET `password` = ?, `password-salt` = ? WHERE `user-id` = ?";
                    $updateStatement = $conn->prepare($updateQuery);
                    $updateStatement->bind_param("ssi", $newPasswordHash, $newPasswordSalt, $userId);

                    if ($updateStatement->execute()) {
                        echo "Password changed successfully! <br> Click <a href=\"index.php\">here</a> to go back.";
                        header('Refresh: 10; URL=index.php');
                    } else {
                        echo "Failed to update password.";
                    }
                } else {
                    echo "New password and confirm new password do not match. <br>";
                }
            } else {
                echo "Incorrect old password. <br>";
            }
        } else {
            echo "User not found. <br>";
        }
    } else {
        // The submitted form is missing required fields
        echo "Please fill out all fields. <br>";
    }
}

// Function to validate old password
function validatePassword($oldPassword, $hashedPassword, $salt) {
    // Use bcrypt for password verification
    return password_verify($oldPassword . $salt, $hashedPassword);
}

// Function to generate salt and hash for new password
function saltAndHash($newPassword) {
    // Generate a random salt
    $newPasswordSalt = uniqid(mt_rand(), true);

    // Use bcrypt for password hashing
    $newPasswordHash = password_hash($newPassword . $newPasswordSalt, PASSWORD_DEFAULT);

    return array($newPasswordHash, $newPasswordSalt); // Return both hashed password and salt
}
?>
