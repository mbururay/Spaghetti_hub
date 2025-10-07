<?php
$host = "localhost";
$db_username = "root";
$db_password = "Bomboclat1!";
$database = "Carbonara";



session_start(); // Start or resume the session

// Check if username is set in session
if (!isset($_SESSION['username'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: http://localhost/Projects/Logins/preLogin.html");
    exit(); // Ensure that script stops here to prevent further execution
}

// Proceed with rendering the HTML content since user is logged in


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
    <title>User Data - Spaghetti Hub</title>
    <link rel="stylesheet" type="text/css" href="viewUser.css">
</head>
<body>

<div id="navigationBar">
    <ul>
    <li><a href="https://localhost/Projects/Landings/adminLanding.php">Home</a></li>
            <li><a href="http://localhost/Projects/Recipes/preRecipe.html">Recipes</a></li>
            <li><a href="http://localhost/Projects/Landings/adminShow.html">Admin</a></li>
            <li><a href="http://localhost/Projects/Logins/preLogin.html">Login</a></li>
            <li id="username-display"><?php echo "Welcome, " . htmlspecialchars($_SESSION['username']); ?></li> <!-- Display username -->
    </ul>
</div>

<div id="main">
    <h2>User Data</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <?php
        // SQL query to fetch data from database (including password)
        $sql = "SELECT userName, userPassword FROM userCred";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>". htmlspecialchars($row["userName"]). "</td>
                        <td>". htmlspecialchars($row["userPassword"]). "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No results</td></tr>";
        }
        ?>
    </table>

    <h2>Recipe Owner Data</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <?php
        // SQL query to fetch data from database (including password)
        $sql = "SELECT repName, repPassword FROM repCred";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>". htmlspecialchars($row["repName"]). "</td>
                        <td>". htmlspecialchars($row["repPassword"]). "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No results</td></tr>";
        }
        ?>
    </table>

    <h2>Administrator Data</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <?php
        // SQL query to fetch data from database (including password)
        $sql = "SELECT adminName, adminPassword FROM adminCred";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>". htmlspecialchars($row["adminName"]). "</td>
                        <td>". htmlspecialchars($row["adminPassword"]). "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No results</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</div>

</body>
</html>
