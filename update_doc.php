<?php

// Include database configuration
@include_once 'config.php';

// Check if the form has been submitted
if(isset($_POST['submit'])) {

    // Get form data
    $id = $_POST['id'];
    $title = $_POST['title'];

    // Check if a new document has been uploaded
    $document = $_FILES['document']['name'];
    $temp_document = $_FILES['document']['tmp_name'];
    if ($document) {
        // Check if file is a PDF or document
        $file_type = strtolower(pathinfo($document, PATHINFO_EXTENSION));
        $allowed_types = array('pdf', 'doc', 'docx', 'txt');
        if (in_array($file_type, $allowed_types)) {
            // Upload file
            move_uploaded_file($temp_document, 'documents/' . $document);
            // Update document record in database
            $query = "UPDATE documents SET title='$title', document='$document' WHERE id='$id'";
        } else {
            // Invalid file type
            $error_message = 'Invalid file type. Please upload a PDF, DOC, DOCX, or TXT file.';
            header("Location: modules.php?error=$error_message");
            exit;
        }
    } else {
        // Update title only in database
        $query = "UPDATE documents SET title='$title' WHERE id='$id'";
    }

    // Execute query
    $result = mysqli_query($conn, $query);

    // Redirect to documents page
    header('Location: modules.php');
    exit;
}

// Get document ID from query parameter
if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];

    // Query database for document with matching ID
    $query = "SELECT * FROM documents WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Set form values to existing document data
    $title = $row['title'];
    $document = $row['document'];
} else {
    // Redirect to documents page if ID not specified
    header('Location: modules.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update Content</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/update_cm.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body>
        <div class="menu">
            <img id="logo" class="logo" src="logo/cyb6.png" alt="CYBERTIPS Logo">
            <ul>
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="CM.php">Content managment</a></li>
                <li><a href="pushnotif.php">Push Notification</a></li>
                <li><a href="index.php">CYBERTIPS</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="body">
            <h1>Update Content</h1>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="<?php echo $title; ?>"><br><br>
                <label for="document">Document:</label>
                <?php if ($document): ?>
                    <a href="documents/<?php echo $document; ?>"><?php echo $document; ?></a>
                <?php endif; ?>
                <input type="file" name="document" id="document"><br><br>
                <input type="submit" name="submit" value="Update Document">
            </form>
        </div>
        <footer>
            <p>CYBERTIPS</p>
        </footer>
        <script src="js/menu.js"></script>
    </body>
</html>