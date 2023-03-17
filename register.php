<!--connection and program-->
<?php

@include 'config.php';

if(isset($_POST['submit'])){

$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$pass = md5($_POST['password']);
$cpass = md5($_POST['cpassword']);
$user_type = $_POST['user_type'];

$select = " SELECT * FROM user_list WHERE email = '$email' && password = '$pass' ";

$result = mysqli_query($conn, $select);

if(mysqli_num_rows($result) > 0){

    $error[] = 'user already exist!';

}else{

    if($pass != $cpass){
        $error[] = 'password not matched!';
    }else{
        $insert = "INSERT INTO user_list(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
        mysqli_query($conn, $insert);
        header('location:login.php');
    }
}
};
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
                    <input type="password" name="cpassword" required placeholder="Password">
                    <select name="user_type">
                        <option value="user">user</option>
                        <option value="admin">admin</option>
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
