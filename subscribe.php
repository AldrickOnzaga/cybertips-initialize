<?php
    include_once 'config.php';
    if (isset($_POST['title']) && isset($_POST['link']) && isset($_POST['notif']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['recipient'])) {
        $title = $_POST['title'];
        $link = $_POST['link'];
        $notif = $_POST['notif'];
        $date_added = date('Y-m-d H:i:s', strtotime($_POST['date'] . ' ' . $_POST['time']));
        $recipient = $_POST['recipient'];
        $sql = "INSERT INTO subscriptions (title, link, notif, date_added, recipient) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'sssss', $title, $link, $notif, $date_added, $recipient);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo 'Success';
        } else {
            echo 'Error';
        }
        mysqli_close($conn);
    }
?>
