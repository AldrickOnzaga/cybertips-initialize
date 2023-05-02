<?php
// Include database configuration
@include_once 'config.php';
session_start();
if (!isset($_SESSION['admin_name'])) {
    // Redirect to homepage if user is not logged in
    header('location:index.php');
    exit;}

// Check if the form has been submitted
if(isset($_POST['submit'])) {
    // Get form data
    $id = $_POST['id'];
    $description = $_POST['description'];

    // Handle file upload
    $image = $_FILES['image']['name'];
    $temp_image = $_FILES['image']['tmp_name'];
    if ($image) {
        // Check if file is an image
        $file_type = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($file_type, $allowed_types)) {
            // Upload file
            move_uploaded_file($temp_image, 'img/' . $image);
        } else {
            // Invalid file type
            $error_message = 'Invalid file type. Please upload a JPEG, PNG, or GIF file.';
            header("Location: update_cm.php?updateid=$id&error=$error_message");
            exit;
        }
    }

    // Update record in database
    $query = "UPDATE cm SET description='$description', img='$image' WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    // Redirect to CM page
    header('Location: CM.php');
    exit;
}

// Check if an ID has been provided in the URL
if(isset($_GET['updateid'])) {
    // Get ID from URL
    $id = $_GET['updateid'];

    // Query database for record with matching ID
    $query = "SELECT * FROM cm WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Get values from database and store in variables
    $image = $row['img'];
    $description = $row['description'];
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
                <li><a href="admin.php">User management</a></li>
                <li><a href="cm.php">Announcement managment</a></li>
                <li><a href="modules.php">Modules management</a></li>
                <li><a href="pushnotif.php">Push Notification</a></li>
                <li><a href="index.php">CYBERTIPS</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="body">
            <h1>Update Content</h1>
            <form action="update_cm.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="image-container">
                    <img src="img/<?php echo $image; ?>" alt="<?php echo $description; ?>">
                </div>
                <input type="file" name="image" accept="image/*">
                <div class="textarea-container">
                    <label for="image-description">Image description:</label>
                    <textarea id="image-description" name="description" rows="4" maxlength="100" required><?php echo $description; ?></textarea>
                </div>
                <button type="submit" name="submit">Update</button>
            </form>
        </div>
        <footer>
            <p>CYBERTIPS</p>
        </footer>
        <script src="js/menu.js"></script>
    </body>
</html>
