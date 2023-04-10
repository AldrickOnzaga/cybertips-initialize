<?php
session_start(); // start the session
@include_once 'config.php';

if(isset($_GET['deleteid'])){

    // validate the id input
    $id = filter_var($_GET['deleteid'], FILTER_VALIDATE_INT);
    if($id === false){
        die("Invalid input data");
    }

    // prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM subscriptions WHERE id = ?");
    $stmt->bind_param("i", $id);

    // execute the statement and redirect to admin page if successful
    if($stmt->execute()){
        header('location:pushnotif.php');
        exit;
    }else{
        die(mysqli_error($conn));
    }
}
?>
