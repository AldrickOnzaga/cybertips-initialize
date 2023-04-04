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
        <link rel="stylesheet" href="css/slideshow.css">
        <link rel="stylesheet" href="css/content.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body>
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
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
            <br></br    >

            <div class="outer-container">
                <div class="inner-container1">
                    <label style="font-size: 2rem; font-weight: bold;">Announcement</label>
                    <div class="controls">
                        <button class="prev" onclick="plusSlides(-1)">&#10094;</button>
                        <button class="next" onclick="plusSlides(1)">&#10095;</button>
                    </div>
                    <div id="display-image">
                        <?php
                        $query = "select * from cm";
                        $result = mysqli_query($conn, $query);

                        while ($data = mysqli_fetch_assoc($result)) {
                            echo '<img src="./img/' . $data['img'] . '"data-description="' . $data['description'] . '">';
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
                        // Query database for documents
                        $query = "SELECT * FROM documents";
                        $result = mysqli_query($conn, $query);

                        // Loop through documents and display in table rows
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td><a href='documents/" . $row['document'] . "' target='_blank'>" . $row['document'] . "</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
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

    </body>
</html>
