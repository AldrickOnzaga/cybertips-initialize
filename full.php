<!-- full.php -->

<?php
// check if image is set
if (isset($_GET['image'])) {
    $image = $_GET['image'];
    
    // query the database for image and description
    $query = "SELECT * FROM cm WHERE img='$image'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        
        // display the image and its description
        echo '<img src="./img/' . $data['img'] . '">';
        echo '<p>' . $data['description'] . '</p>';
    } else {
        echo 'Image not found.';
    }
} else {
    echo 'No image selected.';
}
?>
