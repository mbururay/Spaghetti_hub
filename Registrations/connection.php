<?php


// Database configuration
$host = "localhost";
$username = "root";
$password = "Bomboclat1!";
$database = "Carbonara";

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

// Close connection
mysqli_close($conn);
?>
