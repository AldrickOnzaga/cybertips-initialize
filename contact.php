<!DOCTYPE html>
<html>
    <head>
		<title>Contact Us | CYBERTIPS</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style1.css">
        <link rel="stylesheet" href="css/nav.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body>
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
			<p>
                We are CYBERTIPS, a website dedicated to providing information about online safety and security. Our mission is to help educate people about the risks of the internet and provide tips and resources to stay safe online.
            </p>
            <h1>Contact Us</h1>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $message = $_POST["message"];
                    $to = "aonzaga.k11720977@umak.edu.ph";
                    $subject = "New message from CYBERTIPS contact form";
                    $body = "Name: $name\nEmail: $email\nMessage: $message";
                    if (mail($to, $subject, $body)) {
                        echo "<p>Thank you for contacting us. We'll get back to you shortly.</p>";
                    } else {
                        echo "<p>Oops, something went wrong. Please try again later.</p>";
                    }
                }
            ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <br>
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
                <br>
                <input type="submit" value="Send">
            </form>
        </main>
        
        <footer>
            <p>Created by Aldrick</p>
        </footer>
    </body>
</html>
