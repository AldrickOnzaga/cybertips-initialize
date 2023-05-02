<?php
    include_once 'config.php';
    $id = $_POST['id'];
    $query = "DELETE FROM subscriptions WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo 'Success';
    } else {
        echo 'Error';
    }
    mysqli_close($conn);
?>
