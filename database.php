<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "club";

// Create a MySQL connection
$conn = new mysqli($servername, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
