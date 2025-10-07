<?php
session_start(); // Start or resume the session

// Check if username is set in session
if (!isset($_SESSION['username'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: http://localhost/Projects/Logins/preLogin.html");
    exit(); // Ensure that script stops here to prevent further execution
}

// Proceed with rendering the HTML content since user is logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing - Spaghetti Hub</title>
    <link rel="stylesheet" type="text/css" href="styleI.css">
    <style>
        /* Additional styles for username display */
        #username-display {
            color: #fff;
            font-weight: bold;
            margin-right: 20px;
        }
    </style>
</head>
<body>

<div class="foldNav">
    <div id="navigationBar">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Recipes</a></li>
            <li><a href="#">Donate</a></li>
            <li><a href="logout.php">Logout</a></li> <!-- Add logout link -->
            <li id="username-display"><?php echo "Welcome, " . htmlspecialchars($_SESSION['username']); ?></li> <!-- Display username -->
        </ul>
    </div>

    <div id="aboveTheFold">
        <ul style="list-style: none;">
            <li id="list1">Welcome to Spaghetti Hub</li>
            <li><a style="color : #8e2c2c" href="C:/Users/mburu/OneDrive/Desktop/CARBONARA ASSIGNMENT/Recipes/recipe.html">Explore the Carbonara </a></li>
        </ul>
    </div>
</div>

<div id="belowTheFold">
    <div id="spaghettiBolo">
        <p>Ever wanted to be part of the hub?? well you will have a chance of this by donating all your favourite pasta recipes. Submit your wet juicy mouth watering spaghetti formulas and gain special membership</p>
        <a href="#">Click to submit recipes</a>
    </div>

    <div id="spaghettiCarbo">
        <p>Explore the submitted reccipes by our users and make the best pasta on the globe. Start by exploring the fan favourite ; the tasty beauty of Carbonara from Sicily</p>
        <a href="#">Click for Spaghetti Carbonara</a>
    </div>
</div>

<div id="Testimonials">
    <div id="Walter-White">
        <h3>"I've been thoroughly delighted by everything I've explored on the hub. Each piece of content keeps me coming back, eager to discover more. It's truly a feast for the mind!"</h3>
        <img src="Waltuh.jpg" style="width: 100%; height: 70%; object-fit: cover;" alt="Descriptive alt text">
    </div>

    <div id="Saul">
        <h3>I have being enjoying all the content that I have been enjoying from the hub. Always leaves my mind craving for more</h3>
        <img src="Saul.jpg" style="width: 100%; height: 70%; object-fit: cover;" alt="Descriptive alt text">
    </div>

    <div id="Gus">
        <h3>The hub has consistently provided captivating content that never fails to engage me. Every visit leaves me hungry for more knowledge and insights. It's been an absolute pleasure to dive into their offerings</h3>
        <img src="Gus.jpg" style="width: 100%; height: 70%; object-fit: cover;" alt="Descriptive alt text">
    </div>
</div>

<div id="rick">
    <p>Carbonara – Headquarters<br>
        21620 N 19th Ave<br>
        Phoenix<br>
        AZ 85027<br>
        USA</p>
</div>

</body>
</html>
