<?php 
@include_once 'config.php';

error_reporting(0);

$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {
 
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "./img/" . $filename;
    $description = $_POST['description'];

    // Prepare SQL statement with placeholders
    $sql = "INSERT INTO cm (img, description) VALUES (?, ?)";

    // Initialize a statement object
    $stmt = mysqli_stmt_init($conn);

    // Prepare the statement
    if (mysqli_stmt_prepare($stmt, $sql)) {

        // Bind parameters to the placeholders
        mysqli_stmt_bind_param($stmt, "ss", $filename, $description);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {

            // Now let's move the uploaded image into the folder: image
            if (move_uploaded_file($tempname, $folder)) {
                echo "<h3>  Image uploaded successfully!</h3>";
                header('location: cm.php');
                exit();
            } else {
                echo "<h3>  Failed to upload image!</h3>";
            }
        } else {
            echo "<h3>  Failed to execute statement!</h3>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);

    } else {
        echo "<h3>  Failed to prepare statement!</h3>";
    }
}
?>
