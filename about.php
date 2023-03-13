<!DOCTYPE html>
<html>
	<head>
		<title>About Us | CYBERTIPS</title>
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
			<h1>About Us</h1>
			<p>
                We are CYBERTIPS, a website dedicated to providing information about online safety and security. Our mission is to help educate people about the risks of the internet and provide tips and resources to stay safe online.
            </p>
		</main>

		<footer>
			<!-- Your footer content goes here -->
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
