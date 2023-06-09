<?php
include_once 'config.php';

session_start();

if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $select = "SELECT * FROM user_list WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $hashed_password = $row['password'];

        if(password_verify($password, $hashed_password)){
            if($row['user_type'] == 'admin'){
                $_SESSION['admin_name'] = $row['name'];
                header('location:admin.php');
            }if($row['user_type'] == 'user'){
                $_SESSION['user_name'] = $row['name'];
                header('location:index.php');
            }elseif($row['user_type'] == 'employee'){
                $_SESSION['user_name'] = $row['name'];
                header('location:index.php');
        }else{
            $error[] = 'Incorrect email or password. Please try again';
        }
    }else{
        $error[] = 'Incorrect email or password. Please try again';
    }
    }}
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
    </head>
    <body>
<!-- rest of your HTML code -->
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars">Menu</i>
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

        <!-- <script>
            var img = document.getElementById("logo");
            img.addEventListener("click", function() {
                window.location.href = "http://localhost/cybertips-initialize/index.php";
            });
        </script> -->
        
    </body>
</html>
