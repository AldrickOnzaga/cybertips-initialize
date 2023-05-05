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
        <!-- <link rel="stylesheet" href="css/ddmenu.css"> -->
        <link rel="stylesheet" href="css/slideshow.css">
        <link rel="stylesheet" href="css/content.css">
        <!-- <link rel="stylesheet" href="css/password_generator.css"> -->
        <link rel="stylesheet" href="css/box.css">
        <link rel="stylesheet" href="css/video.css">
        <link rel="stylesheet" href="css/button-list.css">
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
                }elseif(isset($_SESSION['user_name'])) {
                    echo '<li><a href="user.php">'.$_SESSION['user_name'].'</a></li>';
                }elseif(isset($_SESSION['user_name'])) {
                    echo '<li><a href="user.php">'.$_SESSION['user_name'].'</a></li>';
                }
                else {
                    echo '<li><a href="login.php">Log in</a></li>';
                }
                ?>
            </ul>
            <!--<a href="login.php">Log in</a>-->
        </nav>
        <main>
            <h1>Welcome to CYBERTIPS</h1>
            <p>This website will be use for increasing the awareness of the student of the Fort Bonifacio Senior HighSchool</p>
            <video controls controlsList="nodownload" class="main_video" oncontextmenu="return false;">
                <?php
                    $video_src = "video/30sec.mp4"; // Replace with the URL of your video file
                    $video_type = mime_content_type($video_src); // Get the MIME type of the video file
                ?>
                <source src="<?php echo $video_src ?>" type="<?php echo $video_type ?>">
                Your browser does not support the video tag.
            </video>
            <br></br>
            <div class="button-menu">

                <div class="button-menu-list">
                    <a href="#">Tips</a>
                </div>

                <div class="button-menu-list">
                    <a href="learning_materials.php">Modules</a>
                </div>

                <div class="button-menu-list">
                    <a href="#">News</a>
                </div>
                
            </div>
        </main>
        <footer>
                <p>CYBERTIPS</p>
        </footer>
        <!-- for ICON -->
        <!-- <script>
            var img = document.getElementById("logo");
            img.addEventListener("click", function() {
                window.location.href = "http://localhost/cybertips-initialize/index.php";
            });
        </script> -->
        <!-- for slideshow -->
        <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function showSlides(n) {
            var i;
            var slides = document.querySelectorAll('#display-image img');
            var descriptions = document.getElementById('display-description');
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
            descriptions.innerHTML = slides[slideIndex - 1].getAttribute('data-description');
        }
        </script>
        <!-- for password generator -->
        <script>
            var slider = document.getElementById("length");
            var output = document.getElementById("slider-value");
            output.innerHTML = slider.value;
            
            slider.oninput = function() {
                output.innerHTML = this.value;
            }
        </script>
    </body>
</html>
