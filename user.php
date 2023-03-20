<?php

    session_start();

    if(isset($_SESSION['user_name'])){
        $name = $_SESSION['user_name'];
    }else{
        header('location:login.php');
}?>
<!DOCTYPE html>
<html>
    <head>
        <title>User Dashboard</title>
    </head>
    <body>

        <h1>Welcome, <?php echo $name; ?>!</h1>

        <!-- Add your admin dashboard content here -->

        <form action="logout.php" method="post">
            <input type="submit" value="Logout">
        </form>

    </body>
</html>
