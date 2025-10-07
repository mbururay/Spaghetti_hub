<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Spaghetti Hub</title>
    <link rel="stylesheet" type="text/css" href="register.css">
    
    <script>
        function updateFormAction() {
            var userGroup = document.getElementById("user_group").value;
            var form = document.getElementById("registrationForm");
            if (userGroup === "Admin") {
                form.action = "http://localhost/Projects/Registrations/adminReg.php";
            } else if (userGroup === "Recipe Owner") {
                form.action = "http://localhost/Projects/Registrations/recipeOwnerReg.php";
            } else {
                form.action = "http://localhost/Projects/Registrations/userReg.php";
            }
        }
    </script>
</head>
<body>
    <div id="navigationBar">
        <ul>
            <li><img src="logo.jpg" alt="Logo" style="height: 40px;"></li>
            <li><a href="text.html">Help</a></li>
        </ul>
    </div>

    <div id="main">
        <div id="topBar">
            <h2>PLEASE INPUT YOUR DETAILS TO REGISTER</h2>
        </div>

        <div id="login-form">
            <form id="registrationForm" method="post" enctype="multipart/form-data" onsubmit="updateFormAction()">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <label for="rePassword">Retype password</label>
                <input type="password" id="rePassword" name="RePassword" placeholder="Retype Password" required>
                <label for="user_image">User Image</label>
                <input type="file" id="user_image" name="user_image" required>

                <label for="user_group">Select Group</label>
                <select name="user_group" id="user_group" onchange="updateFormAction()" required>
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

                        // Fetch groups from the database
                        $sql = "SELECT userGroup FROM groupTable";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['userGroup']) . "'>" . htmlspecialchars($row['userGroup']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>No groups available</option>";
                        }

                        // Close connection
                        $conn->close();
                    ?>
                </select><br>

                <button type="submit" style="width: 70%; padding: 12px; background-color: rgb(255, 153, 0); color: #fff; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;">
                    Register
                </button>
            </form>
        </div>
    </div>
</body>
</html>
