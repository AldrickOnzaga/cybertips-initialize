<?php

// Include database configuration
@include_once 'config.php';
session_start();
if (!isset($_SESSION['admin_name'])) {
    // Redirect to homepage if user is not logged in
    header('location:index.php');
    exit;}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/cm.css">
        <link rel="stylesheet" href="css/table2.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body>
        <div class="menu">
                <img id="logo" class="logo" src="logo/cyb6.png" alt="CYBERTIPS Logo">
                <ul>
                    <li><a href="admin.php">User management</a></li>
                    <li><a href="cm.php">Announcement management</a></li>
                    <li><a href="modules.php">Modules management</a></li>
                    <li><a href="pushnotif.php">Push Notification</a></li>
                    <li><a href="index.php">CYBERTIPS</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
        </div>
        <div class="body">
            <h1>Announcement management</h1>
            <div class="upload-container">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label for="image-upload">Select an image to upload:</label>
                <input type="file" id="image-upload" name="image" accept=".jpg, .jpeg, .png" required>
                    <div class="textarea-container">
                    <label for="image-description">Image description:</label>
                    <textarea id="image-description" name="description" rows="8" cols="50" maxlength="1000" style="resize:none;" required></textarea>
                    <span class="word-count">0 / 100</span>
                </div>
                <button type="submit" name="upload">Upload</button>
            </form>
            <br></br>
            </div>
            <!-- table -->
            <div class="table-container">
                <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include database configuration
                        @include_once 'config.php';

                        // Query to retrieve uploaded images
                        $query = "SELECT * FROM cm";
                        $result = mysqli_query($conn, $query);

                        // Loop through results and display each row as a table row
                        while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $image = $row['img'];
                        $description = $row['description'];
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td class="image"><img src="img/<?php echo $image; ?>" alt="<?php echo $description; ?>"></td>
                            <td><?php echo $description; ?></td>
                            <td>
                                <button><a href="update_cm.php?updateid=<?php echo $id; ?>" class="text-light">Update</a></button> |
                                <button><a href="delete_cm.php?deleteid=<?php echo $id; ?>" onclick="return confirm('Are you sure?')" name='del-btn' class="fas fa-trash-alt">Delete</a></button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
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
