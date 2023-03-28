<?php
    @include_once 'config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CYBERTIPS</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style1.css">
        <link rel="stylesheet" href="css/nav.css">
        <link rel="stylesheet" href="css/ddmenu.css">
        <link rel="stylesheet" href="css/view.css">
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
            <h1>Welcome to CYBERTIPS</h1>
            <p>This website will be use for increasing the awareness of the student of the Fort Bonifacio Senior HighSchool</p>

            <!-- here is for content management -->

            <div id="slideshow">
                <div id="display-image">
                    <?php
                    $query = "select * from cm";
                    $result = mysqli_query($conn, $query);

                    while ($data = mysqli_fetch_assoc($result)) {
                        echo '<img src="./img/' . $data['img'] . '">';
                    }
                    ?>
                </div>
                <div class="controls">
                    <button class="prev" onclick="plusSlides(-1)">&#10094;</button>
                    <button class="next" onclick="plusSlides(1)">&#10095;</button>
                </div>
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

        <script>
            var slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
                showSlides(slideIndex += n);
            }

            function showSlides(n) {
                var i;
                var slides = document.getElementsByTagName("img");
                if (n > slides.length) {
                    slideIndex = 1;
                }
                if (n < 1) {
                    slideIndex = slides.length;
                }
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                slides[slideIndex - 1].style.display = "block";
            }
        </script>

    </body>
</html>
