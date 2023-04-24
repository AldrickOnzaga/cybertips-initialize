<?php
    include_once 'config.php';
    
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['admin_name'])) {
    // Redirect to homepage if user is not logged in
    header('location:index.php');
    exit;}
    
    if(isset($_GET['updateid'])){
        $id = $_GET['updateid'];

        $sql = "SELECT * FROM user_list WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);
    }

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $user_type = $_POST['user_type'];

        if($password == $cpassword){
            if(strlen($password) >= 8){
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE user_list SET name=?, email=?, password=?, user_type=? WHERE id=?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'ssssi', $name, $email, $hashed_password, $user_type, $id);
                mysqli_stmt_execute($stmt);

                if(mysqli_stmt_affected_rows($stmt) > 0){
                    header('location: admin.php');
                }else{
                    $error[] = 'There was an error while updating the record.';
                }

                mysqli_stmt_close($stmt);
            }else{
                $error[] = 'Password must be at least 8 characters long.';
            }
        }else{
            $error[] = 'Passwords do not match.';
        }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/table.css">
        <link rel="stylesheet" href="css/update.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body>
        <div class="menu">
            <img id="logo" class="logo" src="logo/cyb6.png" alt="CYBERTIPS Logo">
            <ul>
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="cm.php">Announcement managment</a></li>
                <li><a href="modules.php">Modules management</a></li>
                <li><a href="pushnotif.php">Push Notification</a></li>
                <li><a href="index.php">CYBERTIPS</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="body">
            <p>UPDATE</p>
            <div class="form-container">
                <form method="POST">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>

                    <label for="password">New Password:</label>
                    <input type="password" name="password" minlength="8" required>

                    <label for="cpassword">Confirm New Password:</label>
                    <input type="password" name="cpassword" minlength="8" required>

                    <label for="user_type">User Type:</label>
                    <select name="user_type" required>
                        <option value="user" <?php if($row['user_type'] == 'user') echo 'selected'; ?>>User</option>
                        <option value="admin" <?php if($row['user_type'] == 'admin') echo 'selected'; ?>>Admin</option>
                    </select>

                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <button type="submit" name="submit">Update</button>
                </form>
            </div>
        </div>

        <footer>
            <p>CYBERTIPS</p>
        </footer>

        <script>
            const menu = document.querySelector('.menu');
            const menuBtn = document.querySelector('.menu-btn');
            menuBtn.addEventListener('click', () => {
                menu.classList.toggle('active');
            });
        </script>
    </body>
</html>

