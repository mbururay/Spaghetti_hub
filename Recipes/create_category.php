<?php
session_start();

// Database connection details
$host = "localhost";
$db_username = "root";
$db_password = "Bomboclat1!";
$database = "Carbonara";

// Create connection
$conn = mysqli_connect($host, $db_username, $db_password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the registration form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect user input
    $category = $_POST['category'];
    
    // Validate input (add your validation logic here)

    // Prepare and execute SQL statement to insert user into database
    $stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
    $stmt->bind_param("s", $category);  // Corrected the parameter binding
    $stmt->execute();

    // Check if user was successfully inserted
    if ($stmt->affected_rows > 0) {
        // Registration successful, redirect user to login page
        header("Location: http://localhost/PROJECTS/Recipes/recipe.html");
        exit();
    } else {
        // Registration failed, display error message
        echo "Registration failed. Please try again.";
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
