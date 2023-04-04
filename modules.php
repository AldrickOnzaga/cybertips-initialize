<?php

// Include database configuration
@include_once 'config.php';

    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['admin_name'])) {
    // Redirect to homepage if user is not logged in
    header('location:homepage.php');
    exit;}
    
// Check if the form has been submitted
if(isset($_POST['submit'])) {

    // Get form data
    $title = $_POST['title'];

    // Handle document upload
    $document = $_FILES['document']['name'];
    $temp_document = $_FILES['document']['tmp_name'];
    if ($document) {
        // Check if file is a PDF or document
        $file_type = strtolower(pathinfo($document, PATHINFO_EXTENSION));
        $allowed_types = array('pdf', 'doc', 'docx', 'txt');
        if (in_array($file_type, $allowed_types)) {
            // Upload file
            move_uploaded_file($temp_document, 'documents/' . $document);
        } else {
            // Invalid file type
            $error_message = 'Invalid file type. Please upload a PDF, DOC, DOCX, or TXT file.';
            header("Location: modules.php?error=$error_message");
            exit;
        }
    }

    // Insert record into database
    $query = "INSERT INTO documents (title, document) VALUES ('$title', '$document')";
    $result = mysqli_query($conn, $query);

    // Redirect to documents page
    header('Location: modules.php');
    exit;
}
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
                <img id="logo" class="logo" src="logo/cyb6.png" alt="CYBERTIPS Logo">
                <ul>
                    <li><a href="admin.php">Dashboard</a></li>
                    <li><a href="cm.php">Announcement managment</a></li>
                    <li><a href="modules.php">Modules management</a></li>
                    <li><a href="pushnotif.php">Push Notification</a></li>
                    <li><a href="index.php">CYBERTIPS</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
        </div>
        <div class="body">
            <h1>Modules</h1>
            <form method="POST" enctype="multipart/form-data">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title"><br><br>
                <label for="document">Document:</label>
                <input type="file" name="document" id="document"><br><br>
                <input type="submit" name="submit" value="Upload">
            </form>
            <!-- table -->
            <div class="table-container">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Document</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query to retrieve uploaded documents
                            $query = "SELECT * FROM documents";
                            $result = mysqli_query($conn, $query);

                            // Loop through results and display each row as a table row
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $title = $row['title'];
                                $document = $row['document'];
                            ?>
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><a href="documents/<?php echo $document; ?>" target="_blank"><?php echo $document; ?></a></td>
                                    <td>
                                        <button class="btn btn-primary"><a href="update_doc.php?updateid=<?php echo $id; ?>" class="text-light">Update</a></button> |
                                        <button class="btn btn-danger"><a href="delete_doc.php?deleteid=<?php echo $id; ?>" onclick="return confirm('Are you sure?')" name='del-btn' class="fas fa-trash-alt"></a></button>
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
    </body>
</html>
