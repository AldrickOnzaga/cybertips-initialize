<?php
@include_once 'config.php';

if(isset($_GET['deleteid'])){
    $id = filter_var($_GET['deleteid'], FILTER_VALIDATE_INT);

    if($id === false){
        die("Invalid input data");
    }

    $stmt = $conn->prepare("DELETE FROM user_list WHERE id = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        header('location:admin.php?');
    }else{
        die(mysqli_error($conn));
    }
}
?>