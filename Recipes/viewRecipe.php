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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes - Spaghetti Hub</title>
    <link rel="stylesheet" type="text/css" href="viewRecipe.css">
</head>
<body>

<div id="navigationBar">
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Recipes</a></li>
        <li><a href="#">Donate</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div id="main">
    <h2>Recipes</h2>
    <div class="table-container">
        <table>
            <tr>
                <th>Id</th>
                <th>Recipe Name</th>
                <th>Recipe Owner</th>
                <th>Created At</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <?php
            // SQL query to fetch data from database
            $sql = "SELECT id, recipe_name, repName, created_at, recipe_image FROM recipetable";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>". htmlspecialchars($row["id"]). "</td>
                            <td>". htmlspecialchars($row["recipe_name"]). "</td>
                            <td>". htmlspecialchars($row["repName"]). "</td>  
                            <td>". htmlspecialchars($row["created_at"]). "</td> 
                            <td><img src='". htmlspecialchars($row["recipe_image"]). "' alt='Recipe Image' style='width:100px;height:100px;'></td>
                            <td>
                                <a href='recipeDetail.php?id=".htmlspecialchars($row["id"])."'>View</a> |
                                <a href='editRecipe.php?id=".htmlspecialchars($row["id"])."'>Edit</a> |
                                <a href='deleteRecipe.php?id=".htmlspecialchars($row["id"])."' onclick='return confirm(\"Are you sure you want to delete this recipe?\")'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No results found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>
