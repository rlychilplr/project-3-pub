<?php
// check if email already exists
function emailExists($tmpemail) {
    require "database-connect.php";
    $stmt = $conn->prepare("SELECT email FROM user WHERE email = ?");
    $stmt->bind_param("s", $tmpemail);
    $stmt->execute();

    $stmt->bind_result($email_found);
    $stmt->fetch();

    $stmt->close();
    $conn->close();

    return $email_found ? true : false;
}

// check if username already exists
function usernameExists($tmpusername) {
    require "database-connect.php";
    $stmt = $conn->prepare("SELECT username FROM user WHERE username = ?");
    $stmt->bind_param("s", $tmpusername);
    $stmt->execute();

    $stmt->bind_result($username_found);
    $stmt->fetch();

    $stmt->close();
    $conn->close();

    return $username_found ? true : false;
}

// Check password length and hash it
function validatePassword($tmppassword) {
    if (strlen($tmppassword) >= 6 && strlen($tmppassword) <= 120) {
        return saltAndHash($tmppassword);
    } else {
        return false;
    }
}

function saltAndHash($tmppassword) {
    // Generate a random salt
    $salt = bin2hex(random_bytes(16));

    // Use bcrypt for password hashing
    $options = [
        'cost' => 12,
    ];
    $hashedPassword = password_hash($tmppassword . $salt, PASSWORD_BCRYPT, $options);

    return array($hashedPassword, $salt); // Return both hashed password and salt
}

$email = $_POST['email'];
$password = $_POST['psw'];
$passwordrepeat = $_POST['psw-repeat'];
$username = $_POST['username'];
$displayname = $_POST['displayname'];

//sanitize email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

//sanitize username
$username = filter_var($username, FILTER_SANITIZE_STRING);

//sanitize displayname
$displayname = filter_var($displayname, FILTER_SANITIZE_STRING);

// check if given passwords match
list($hashedPassword, $salt) = validatePassword($password);

// if email and username are not found in the database and the passwords match, insert the user into the database
if (!emailExists($email) && !usernameExists($username) && $password === $passwordrepeat && $hashedPassword !== false) {
    require "database-connect.php";
    $stmt = $conn->prepare("INSERT INTO user (username, password, `password-salt`, displayname, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $hashedPassword, $salt, $displayname, $email);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('Location: '.'inloggen.php');
} elseif (emailExists($email)){
    echo "this email already has an account associated with it, please try again with a different email or<br>the given email is invalid<br>";
    echo "you will be redirected back in 10 seconds or click <a href='inloggen.php'>here</a><br>";
    header('Refresh: 10; URL=inloggen.php');
} elseif (usernameExists($username)){
    echo "this username already has an account associated with it, please try again with a different username<br>";
    echo "you will be redirected back in 5 seconds or click <a href='inloggen.php'>here</a><br>";
    header('Refresh: 5; URL=inloggen.php');
} elseif ($password !== $passwordrepeat && $hashedPassword == false){
    echo "your passwords do not match or";
    echo "the password is too long or too short, passwords have to be 6-120 characters long<br>";
    echo "you will be redirected back in 10 seconds or click <a href='inloggen.php'>here</a><br>";
    header('Refresh: 10; URL=inloggen.php');
} else {
    echo "i do not know what you did but please try again<br>";
    echo "you will be redirected back in 5 seconds or click <a href='inloggen.php'>here</a><br>";
    header('Refresh: 5; URL=inloggen.php');
}