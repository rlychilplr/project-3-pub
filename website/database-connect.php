<?php
// connect to mysql db
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "chans";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else{
  // echo "success";
}