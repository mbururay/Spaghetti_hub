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
    $username = $_POST['new_username'];
    $password = $_POST['new_password'];
    $user_image = $_FILES['user_image']['name']; // Get the name of the uploaded image file

    // Basic validation
    if (empty($username) || empty($password)) {
        echo "All fields are required.";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Specify the directory where you want to upload the image
    $upload_directory = "C:/Users/mburu/OneDrive/Desktop/CARBONARA ASSIGNMENT/Landing page Assignment/Projects/Specials/userUploads/";

    // Ensure the directory exists
    if (!is_dir($upload_directory)) {
        mkdir($upload_directory, 0777, true);
    }

    // Create the full path for the uploaded image
    $user_image_path = $upload_directory . basename($user_image);

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $user_image_path)) {
        // Prepare and execute SQL statement to insert user into database
        $stmt = $conn->prepare("INSERT INTO repCred (repName, repPassword, repImage) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $user_image); // Bind user image name to the statement
        
        $stmt->execute();

        // Check if user was successfully inserted
        if ($stmt->affected_rows > 0) {
            // Registration successful, redirect user to login page
            header("Location: http://localhost/Projects/Specials/succ.html");
            exit();
        } else {
            // Registration failed, display error message
            echo "Registration failed. Please try again.";
        }

        // Close statement
        $stmt->close();
    } else {
        // Failed to upload image
        echo "Sorry, there was an error uploading your image.";
    }
}

// Close database connection
$conn->close();
?>
