<?php
// IMPORTANT: These are placeholder credentials.
// Please replace them with your actual database credentials
// and consider using environment variables for better security.
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "rocksure_operators";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
