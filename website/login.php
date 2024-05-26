<?php
session_start(); // Start session to manage user login state

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    require "database-connect.php";

    // Get username and password from form
    $username = $_POST['uname'];
    $password = $_POST['psw'];

    // Query database to fetch user data based on username
    $stmt = $conn->prepare("SELECT `user-id`, `username`, `password`, `password-salt`, `displayname` FROM `user` WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $db_username, $hashedPassword, $salt, $db_displayname);
    $stmt->fetch();
    $stmt->close();

    // Verify password
    if (password_verify($password . $salt, $hashedPassword)) {
        // Password is correct, set session variables
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $db_username;
        $_SESSION['displayname'] = $db_displayname;

        // Check if user is a moderator or admin
        $stmt = $conn->prepare("SELECT `moderator`, `admin` FROM `medewerker` WHERE `user-id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($moderator, $admin);
        $stmt->fetch();
        $stmt->close();

        // Set session variables for moderator and admin
        $_SESSION['moderator'] = $moderator;
        $_SESSION['admin'] = $admin;

        header('Location: index.php');
        exit();
    } else {
        // Password is incorrect
        echo "Invalid username or password.<br>";
        echo 'click <a href="inloggen.php">here</a> to go back or wait 10 seconds.';
        header('Refresh: 10; URL=inloggen.php');
    }

    // Close database connection
    $conn->close();
}
?>