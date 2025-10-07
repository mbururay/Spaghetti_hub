<?php
$host = "localhost";
$db_username = "root";
$db_password = "Bomboclat1!";
$database = "Carbonara";

// Create connection
$conn = new mysqli($host, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the recipe from the database
    $sql = "DELETE FROM recipetable WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Recipe deleted successfully";
        header('Location: http://localhost/Projects/Recipes/viewRecipe.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
