<?php
$servername = "localhost";
$username = "root";
$password = "Bomboclat1!";
$dbname = "carbonara";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['new_username'];

    // Delete user account
    $sql = "DELETE FROM userCred WHERE userName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    
    if ($stmt->execute()) {
        echo "User account deleted successfully.";
        header("Location: http://localhost/Projects/Specials/delete/suc.html");
        exit();
    } else {
        echo "Error deleting user account: " . $conn->error;
    }
    
    $stmt->close();
}

$conn->close();
?>
