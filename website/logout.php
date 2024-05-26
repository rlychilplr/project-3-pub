<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// This will destroy the session entirely including the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

// Redirect to the homepage (or wherever you want)
header("Location: index.php");