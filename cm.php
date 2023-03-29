<?php

// Include database configuration
@include_once 'config.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/table.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body>
        <div class="menu">
                <img id="logo" class="logo" src="img/cyb6.png" alt="CYBERTIPS Logo">
                <ul>
                    <li><a href="admin.php">Dashboard</a></li>
                    <li><a href="CM.php">Content managment</a></li>
                    <li><a href="pushnotif.php">Push Notification</a></li>
                    <li><a href="index.php">CYBERTIPS</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
        </div>
        <div class="body">
            <h1>Content Management</h1>
            <div class="upload-container">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label for="image-upload">Select an image to upload:</label>
                <input type="file" id="image-upload" name="image" accept=".jpg, .jpeg, .png" required>
                    <div class="textarea-container">
                    <label for="image-description">Image description:</label>
                    <textarea id="image-description" name="description" rows="4" maxlength="100" required></textarea>
                    <span class="word-count">0 / 100</span>
                </div>
                <button type="submit" name="upload">Upload</button>
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
        <script>
             const textarea = document.getElementById('image-description');
            const wordCountSpan = document.querySelector('.word-count');

            textarea.addEventListener('input', function() {
            const wordCount = textarea.value.trim().split(/\s+/).length;
            wordCountSpan.textContent = wordCount + ' / 100';
            });

        </script>
    </body>
</html>
