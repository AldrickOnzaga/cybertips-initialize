<?php

    @include_once 'config.php';

    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CYBERTIPS - User Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style1.css">
        <link rel="stylesheet" href="css/nav.css">
        <link rel="stylesheet" href="css/credential.css">
        <link rel="stylesheet" href="css/notif.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body>
        <nav>
                <input type="checkbox" id="check">
                <label for="check" class="checkbtn">
                    <i class="fas fa-bars">menu</i>
                </label>
                <img id="logo" class="logo" src="logo/cyb6.png" alt="CYBERTIPS Logo">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php
                    if(isset($_SESSION['admin_name'])) {
                        echo '<li><a href="admin.php">'.$_SESSION['admin_name'].'</a></li>';
                    } elseif(isset($_SESSION['user_name'])) {
                        echo '<li><a href="user.php">'.$_SESSION['user_name'].'</a></li>';
                        $name = $_SESSION['user_name'];
                    } else {
                        echo '<li><a href="login.php">Log in</a></li>';
                    }
                    ?>
                </ul>
                <!--<a href="login.php">Log in</a>-->
        </nav>
        <main>
            <h1>Welcome, <?php echo $name; ?>!</h1>
            <form action="logout.php" method="post">
                <input type="submit" value="Logout">
            </form>
            <!-- Notification -->
            <div class="notification-container">
                <?php
                    $username = $_SESSION['user_name'];
                    $query = "SELECT * FROM subscriptions WHERE recipient = '$username'";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) == 0) {
                        echo '<p>No Notification has been made</p>';
                    } else {
                        while ($data = mysqli_fetch_assoc($result)) {
                            echo '<div class="notif">';
                            echo '<h2>' . $data['title'] . '</h2>';
                            echo '<a href="' . $data['link'] . '">' . $data['link'] .'</a>';
                            echo '<p>' . $data['notif'] . '</p>';
                            echo '<button type="button" class="delete-button" data-id="' . $data['id'] . '">Close</button>';
                            echo '</div>';
                        }                                       
                    }
                ?>
            </div>
        </main>
        <footer>
                <p>CYBERTIPS</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.delete-button').click(function() {
                    $(this).parent().hide();
                    // You can also use AJAX to send a request to the server to mark the notification as "deleted"
                    // by setting a flag in the database instead of actually deleting the record.
                });
            });
        </script>
    </body>
</html>
