<!DOCTYPE html>
<html>
    <head>
        <title>CYBERTIPS - Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style1.css">
        <link rel="stylesheet" href="css/nav.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body>
    <?php

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get the username and password from the form data
        $username = $_POST["username"];
        $password = $_POST["password"];

        // TODO: Add validation and authentication logic here
        // For example, you might check if the username and password
        // match a user account in your database

        // If the username and password are valid, redirect the user
        // to a protected page
        header("Location: protected.php");
        exit;
    }
    ?>

        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <a href="index.php"><img class="logo" src="img/cyb6.png" alt="CYBERTIPS Logo"></a>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Log in</a></li>
            </ul>
            <!--<a href="login.php">Log in</a>-->
        </nav>
        
        <main>
            <h1>Login</h1>
            <form method="post" action="login.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <br><br>
                <input type="submit" value="Login">
            </form>
        </main>
        
        <footer>
            <p>Created by Aldrick</p>
        </footer>
    </body>
</html>
