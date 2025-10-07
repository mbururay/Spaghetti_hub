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
    $id = $_POST['id'];
    $recipe_name = $_POST['recipe_name'];
    $ingredients = $_POST['ingredients'];
    $repName = $_POST['repName'];
    $instructions = $_POST['instructions'];

    // Upload recipe image if provided
    $recipe_image = $_POST['existing_image']; // Default to existing image
    if ($_FILES['recipe_image']['error'] === UPLOAD_ERR_OK) {
        $recipe_image_name = $_FILES['recipe_image']['name'];
        $recipe_image_tmp_name = $_FILES['recipe_image']['tmp_name'];
        $upload_directory = "uploads/";
        $recipe_image_path = $upload_directory . $recipe_image_name;
        move_uploaded_file($recipe_image_tmp_name, $recipe_image_path);
        $recipe_image = $recipe_image_path;
    }

    // Prepare and execute SQL statement to update recipe in database
    $stmt = $conn->prepare("UPDATE recipetable SET recipe_name=?, ingredients=?, recipe_image=?, repName=?, instructions=? WHERE id=?");
    $stmt->bind_param("sssssi", $recipe_name, $ingredients, $recipe_image, $repName, $instructions, $id);
    $stmt->execute();

    // Check if recipe was successfully updated
    if ($stmt->affected_rows > 0) {
        // Recipe update successful
        echo "Recipe updated successfully.";
        header('Location: http://localhost/Projects/Recipes/viewRecipe.php'); // Redirect to the view recipes page
        exit();
    } else {
        // Recipe update failed
        echo "Error: Unable to update recipe.";
    }

    // Close statement
    $stmt->close();
}

// Fetch recipe details for editing
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM recipetable WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No recipe found!";
        exit();
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Recipe</title>
    <link rel="stylesheet" type="text/css" href="addRecipe.css">
</head>
<body>
    <div id="navigationBar">
        <ul>
            <li><img src="logo.jpg" alt="Logo" style="height: 40px;"></li>
            <li><a href="text.html">Help</a></li>
        </ul>
    </div>

    <div class="container">
        <div id="topBar">
            <h2>Edit Recipe</h2>
        </div>
        <form action="editRecipe.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($row['recipe_image']); ?>">
            
            <label for="recipe_name">Recipe Name</label>
            <input type="text" id="recipe_name" name="recipe_name" value="<?php echo htmlspecialchars($row['recipe_name']); ?>" required>
            
            <label for="ingredients">Ingredients</label>
            <textarea id="ingredients" name="ingredients" required><?php echo htmlspecialchars($row['ingredients']); ?></textarea>

            <label for="recipe_image">Recipe Image</label>
            <input type="file" id="recipe_image" name="recipe_image" accept="image/*">
            <img src="<?php echo htmlspecialchars($row['recipe_image']); ?>" alt="Current Image" style="width:100px;height:100px;display:block;margin-top:10px;">

            <label for="repName">Recipe Owner username</label>
            <input type="text" id="repName" name="repName" value="<?php echo htmlspecialchars($row['repName']); ?>" required>

            <label for="instructions">Instructions</label>
            <textarea id="instructions" name="instructions"><?php echo htmlspecialchars($row['instructions']); ?></textarea>

            <button type="submit">Update Recipe</button>
        </form>
    </div>
</body>
</html>
