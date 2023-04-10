<?php
    include_once 'config.php';
    if (isset($_POST['title']) && isset($_POST['link']) && isset($_POST['notif'])) {
        $title = $_POST['title'];
        $link = $_POST['link'];
        $notif = $_POST['notif'];
        $sql = "INSERT INTO subscriptions (title, link, notif) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'sss', $title, $link, $notif);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo 'Success';
        } else {
            echo 'Error';
        }
        mysqli_close($conn);
    }
?>
