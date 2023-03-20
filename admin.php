<?php

    session_start();

    if(isset($_SESSION['admin_name'])){
        $name = $_SESSION['admin_name'];
    }else{
        header('location:login.php');
}?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

    <h1>Welcome, <?php echo $name; ?>!</h1>

    <!-- Add your admin dashboard content here -->

    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>

</body>
</html>
