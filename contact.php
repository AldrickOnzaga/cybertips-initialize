<!DOCTYPE html>
<html>
    <head>
		<title>Contact Us | CYBERTIPS</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style1.css">
        <link rel="stylesheet" href="css/nav.css">
        <link rel="stylesheet" href="css/contact_form.css">
        <link rel="stylesheet" href="css/box.css">
        <link rel="stylesheet" href="css/contact-us.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body>
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
                <?php
                session_start();
                if(isset($_SESSION['admin_name'])) {
                    echo '<li><a href="admin.php">'.$_SESSION['admin_name'].'</a></li>';
                } elseif(isset($_SESSION['user_name'])) {
                    echo '<li><a href="user.php">'.$_SESSION['user_name'].'</a></li>';
                    /*echo '<li class="dropdown">';
                    echo '<a href="#" class="dropbtn">'.$_SESSION['user_name'].' <i class="fa fa-caret-down"></i></a>';
                    echo '<div class="dropdown-content">';
                    echo '<a href="userdash.php">Dashboard</a>';
                    echo '<a href="logout.php">Logout</a>';
                    echo '</div>';
                    echo '</li>';*/
                } else {
                    echo '<li><a href="login.php">Log in</a></li>';
                }
                ?>
            </ul>
            <!--<a href="login.php">Log in</a>-->
        </nav>
        
        <main>
			<p>
                We are CYBERTIPS, a website dedicated to providing information about online safety and security. Our mission is to help educate people about the risks of the internet and provide tips and resources to stay safe online.
            </p>
            <br></br>
            <div class="contact-us">
                <h1>
                    CONTACT US
                </h1>
                <p>
                    If there is anything you want to discuss with us, Please email us at:
                </p>
                <p>
                    email@email.com
                </p>
            </div>
        </main>
        <footer>
                <p>CYBERTIPS</p>
        </footer>

        <!-- <script>
            var img = document.getElementById("logo");
            img.addEventListener("click", function() {
                window.location.href = "http://localhost/cybertips-initialize/index.php";
            });
        </script> -->
        
    </body>
</html>
