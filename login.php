<!DOCTYPE html>
<html>
    <head>
        <title>CYBERTIPS - Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style1.css">
        <link rel="stylesheet" href="css/nav.css">
        <link rel="stylesheet" href="css/credential.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body>
    <?php

    // Check if the form was submitted
    /*if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
    }*/
    ?>
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <img id="logo" class="logo" src="img/cyb6.png" alt="CYBERTIPS Logo">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Log in</a></li>
            </ul>
            <!--<a href="login.php">Log in</a>-->
        </nav>
        
        <main>
            <div class="form-container">
                <form action="" method="post">
                        <h3>login now</h3>
                        <?php
                            if(isset($error)){
                                foreach($error as $error){
                                echo '<span class="error-msg">'.$error.'</span>';
                            };
                        };
                        ?>
                        <input type="email" name="email" required placeholder="Email">
                        <input type="password" name="password" required placeholder="Password">
                        <input type="submit" name="submit" value="login now" class="form-btn">
                        <p>don't have an account? <a href="register.php">register now</a></p>
                </form>
            </div>
        </main>
        
        <footer>
            <p>Created by Aldrick</p>
        </footer>

        <script>
            var img = document.getElementById("logo");
            img.addEventListener("click", function() {
                window.location.href = "http://localhost/cybertips-initialize/index.php";
            });
        </script>
        
    </body>
</html>
