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
            <br></br>
            <div class="box">
                <div class="outer-container">
                    <div class="inner-container1">
                        <label style="font-size: 2rem; font-weight: bold;">Announcement</label>
                        <div class="controls">
                            <button class="prev" onclick="plusSlides(-1)">&#10094;</button>
                            <button class="next" onclick="plusSlides(1)">&#10095;</button>
                        </div>
                        <div id="display-image">
                            <?php
                            $query = "SELECT * FROM cm";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) == 0) {
                                echo '<p>No announcement has been made</p>';
                            } else {
                                while ($data = mysqli_fetch_assoc($result)) {
                                    echo '<img src="./img/' . $data['img'] . '" data-description="' . $data['description'] . '">';
                                }
                            }
                            ?>
                        </div>

                        <div id="display-description"></div>
                        </div>
                    <div class="inner-container2">
                        <label style="font-size: 2rem; font-weight: bold;">Modules</label>
                        
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Document</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM documents";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) == 0) {
                                echo '<p>No announcement has been made</p>';
                            } else {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['title'] . "</td>";
                                    echo "<td><a href='documents/" . $row['document'] . "' target='_blank'>" . $row['document'] . "</a></td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <!-- password generator -->
            <div class="password_generator">
                <h1>Password Generator</h1>
                <p>Useful resources for establishing secure, unpredictable passwords that are hard for others to decipher or guess include password generators. For the protection of sensitive data, such as financial or personal information, strong passwords are essential. They can also assist prevent unwanted access to online accounts.</p><br></br>
                <p>People can also benefit from employing password generators to prevent the widespread mistake of using overused or simple-to-guess passwords, which can leave them open to hacking and identity theft. For each account, people should come up with a special, complicated password to lower the possibility of identity theft.</p><br></br>
                <p>In general, password generators are a safe and practical approach to create robust, random passwords that can help protect personal data.</p><br></br>
                <form method="post">
                    <label class="label" for="length">Password length (8-32):</label>
                    <div class="slidecontainer">
                        <input type="range" min="8" max="32" value="8" class="slider" id="length" name="length">
                        <span id="slider-value"></span>
                    </div>
                    <br><br>
                    <input type="checkbox" id="uppercase" name="uppercase" value="1">
                    <label class="label" for="uppercase">Include uppercase letters (A-Z)</label><br>
                    <input type="checkbox" id="lowercase" name="lowercase" value="1" checked>
                    <label class="label" for="lowercase">Include lowercase letters (a-z)</label><br>
                    <input type="checkbox" id="numbers" name="numbers" value="1" checked>
                    <label class="label" for="numbers">Include numbers (0-9)</label><br>
                    <input type="checkbox" id="special" name="special" value="1">
                    <label class="label" for="special">Include special characters (!@#$%^&*)</label><br><br>
                    <input type="submit" name="generate" value="Generate Password">
                </form>
                <?php
                if (isset($_POST['generate'])) {
                    $length = $_POST['length'];
                    $uppercase = isset($_POST['uppercase']);
                    $lowercase = isset($_POST['lowercase']);
                    $numbers = isset($_POST['numbers']);
                    $special = isset($_POST['special']);
                    $password = generate_password($length, $uppercase, $lowercase, $numbers, $special);
                    echo '<script>alert("Your password is: ' . $password . '");</script>';
                }

                function generate_password($length, $uppercase, $lowercase, $numbers, $special) {
                    $chars = '';
                    if ($uppercase) $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    if ($lowercase) $chars .= 'abcdefghijklmnopqrstuvwxyz';
                    if ($numbers) $chars .= '0123456789';
                    if ($special) $chars .= '!@#$%^&*';
                    $password = '';
                    for ($i = 0; $i < $length; $i++) {
                        $password .= $chars[rand(0, strlen($chars) - 1)];
                    }
                    return $password;
                }
                ?>
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
