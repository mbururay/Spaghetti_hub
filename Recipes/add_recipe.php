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

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect user input
    $recipe_name = $_POST['recipe_name'];
    $ingredients = $_POST['ingredients'];
    $repName = $_POST['repName'];
    $instructions = $_POST['instructions'];

    // Upload recipe image
    $recipe_image = null;
    if ($_FILES['recipe_image']['error'] === UPLOAD_ERR_OK) {
        $recipe_image_name = $_FILES['recipe_image']['name'];
        $recipe_image_tmp_name = $_FILES['recipe_image']['tmp_name'];
        $upload_directory = "uploads/";
        $recipe_image_path = $upload_directory . $recipe_image_name;
        move_uploaded_file($recipe_image_tmp_name, $recipe_image_path);
        $recipe_image = $recipe_image_path;
    }

    // Prepare and execute SQL statement to insert recipe into database
    $stmt = $conn->prepare("INSERT INTO recipetable (recipe_name, ingredients, recipe_image, repName, instructions) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $recipe_name, $ingredients, $recipe_image, $repName, $instructions);
    $stmt->execute();

    // Check if recipe was successfully inserted
    if ($stmt->affected_rows > 0) {
        // Recipe insertion successful
        echo "Recipe added successfully.";
        header('Location: http://localhost/Projects/Recipes/preRecipe.html');
    } else {
        // Recipe insertion failed
        echo "Error: Unable to add recipe.";
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
