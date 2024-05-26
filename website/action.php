<?php
session_start();

include("database-connect.php");

// Check if the sign-up form was submitted
if(isset($_POST['signup_submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];
}
