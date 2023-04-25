<!--connection and program-->
<?php

require_once 'config.php';

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

    // Validate input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Invalid email format';
    }
    if (strlen($password) < 8) {
        $error[] = 'Password must be at least 8 characters long';
    }
    if ($password !== $confirm_password) {
        $error[] = 'Passwords do not match';
    }

    // Check if user already exists
    $stmt = $conn->prepare("SELECT * FROM user_list WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error[] = 'User already exists';
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO user_list(name, email, password, user_type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $user_type);
        $stmt->execute();
        header('location: login.php');
        exit();
    }
}

?>


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
        <!--new code-->
    </head>
    <body>

        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <img id="logo" class="logo" src="logo/cyb6.png" alt="CYBERTIPS Logo">
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
                    <h3>register now</h3>
                    <?php
                    if(isset($error)){
                        foreach($error as $error){
                            echo '<span class="error-msg">'.$error.'</span>';
                        };
                    };
                    ?>
                    <input type="text" name="name" required placeholder="Name">
                    <input type="email" name="email" required placeholder="Email">
                    <input type="password" name="password" required placeholder="Password">
                    <input type="password" name="cpassword" required placeholder="Confirm Password">
                    <select name="user_type">
                        <option value="user">user</option>
                        <option value="employee">employee</option>
                    </select>
                    <input type="submit" name="submit" value="register now" class="form-btn">
                    <p>already have an account? <a href="login.php">login now</a></p>
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
