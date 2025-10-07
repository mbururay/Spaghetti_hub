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

// Get the recipe id from the URL
$recipe_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the recipe details from the database
$sql = "SELECT recipe_name, ingredients, repName, created_at, instructions, recipe_image FROM recipetable WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$stmt->bind_result($recipe_name, $ingredients, $repName, $created_at, $instructions, $recipe_image);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipe_name); ?> - Recipe Detail</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        #recipe-title {
            color: black;
        }

        .body {
            background-image: url("background.jpg");
            font-family: Comic Sans MS;
        }

        img {
            border: 5px solid #8e2c2c;
            width: 500px;
        }

        #carba {
            margin-top: 0px;
            margin-bottom: 50px;
            margin-right: 255px;
            margin-left: 170px;
            width: 900px;
            line-height: 270%;
            color: black;
            font-style: italic;
        }

        #ingredients {
            text-align: left;
            margin-left: 35px;
            margin-top: 10px;
            background-color: antiquewhite;
            border-radius: 5px;
            margin-right: 40px;
            margin-bottom: 0px;
            height: 310px;
            position: relative;
            transform: translate(0px, -70px);
        }

        #ingredients h3 {
            position: relative;
            transform: translate(10px, 10px);
        }

        #steps {
            text-align: left;
            position: relative;
            transform: translate(0px, -50px);
            margin-bottom: 0px;
        }

        #intro {
            text-align: left;
            margin-left: 35px;
            margin-top: 10px;
            margin-right: 40px;
            margin-bottom: 10px;
            height: 150px; /* Adjusted height for a smaller intro section */
        }

        #steps h3 {
            position: relative;
            transform: translate(20px, 0px);
        }

        .spacing {
            margin-right: 300px;
        }

        .rick {
            position: relative;
            transform: translate(15px, -56px);
            margin-left: 10px;
            margin-top: 0px;
            color: antiquewhite;
        }

        .scroller {
            position: relative;
            transform: translate(-20px, 0px);
            color: antiquewhite;
        }

        a:visited {
            color: burlywood;
        }
    </style>
</head>
<body class="body">
    <div style="text-align: center;">
        <header id="top">
            <h1 style="font-style: italic;">My Recipe Book</h1>
        </header>

        <nav>
            <a href="index.php" style="background-color:white">
                <button style="background-color:maroon;">
                    <p style="color: white;">Back to List</p>
                </button>
            </a>
            <br>
        </nav>

        <div id="carba" style="background-color: white">
            <h1 id="recipe-title"><?php echo htmlspecialchars($recipe_name); ?></h1>

            <?php if ($recipe_image): ?>
                <img src="<?php echo htmlspecialchars($recipe_image); ?>" alt="Recipe Image">
            <?php else: ?>
                <img src="default-image.jpg" alt="Default Image">
            <?php endif; ?>

            <div id="intro" style="text-align: justify">
                <p>Explore this new recipe and consider donating to support the site. Enjoy all that the hub has to offer!</p>
            </div>

            <div id="ingredients" style="list-style-position: inside">
                <h3 style="font-weight: bold;">Ingredients</h3>
                <p><?php echo nl2br(htmlspecialchars($ingredients)); ?></p>
            </div>

            <div id="steps">
                <h3>Steps</h3>
                <p><?php echo nl2br(htmlspecialchars($instructions)); ?></p>
            </div>

            <div class="rick" style="text-align: left;">
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&pp=ygUXbmV2ZXIgZ29ubmEgZ2l2ZSB5b3UgdXA%3D">Recipe by uncleroger.com</a>
            </div>

            <div class="scroller" style="text-align: right">
                <a href="#top">Back to top</a>
            </div>
        </div>

        <footer>
            <p>Made by Ray Mburu &copy;</p>
        </footer>
    </div>
</body>
</html>
