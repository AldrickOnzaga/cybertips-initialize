<?php

    @include_once 'config.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Push Notification</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/pushnotif.css">
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
            <h1>Push Notification</h1>
            <form method="post" enctype="multipart/form-data">
                <label for="image-description">Title:</label>
                <div class="textarea-container-pushnotif-title">
                    <textarea id="image-description" name="title" rows="4" maxlength="100" required></textarea>
                </div>
            
                <label for="image-description">Link:</label>
                <div class="textarea-container-pushnotif-link">
                    <textarea id="image-description" name="link" rows="4" maxlength="100" required></textarea>
                </div>
             
                <label for="Notification">Notification:</label>
                <div class="textarea-container-pushnotif">
                    <textarea id="notif" name="notif" rows="4" maxlength="1000" required></textarea>
                    <span class="word-count">0</span>
                </div>
                <button class="push-button" type="submit" name="push">PUSH</button>
            </form>
            <div class="table-container">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>link</th>
                                <th>notif</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                            $sql = "SELECT * FROM subscriptions";
                            $stmt = mysqli_prepare($conn, $sql);
                            if ($stmt) {
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                if(mysqli_num_rows($result)>0){
                                    while($row=mysqli_fetch_assoc($result)){
                                        $id=$row['id'];
                                        // process the row data                
                        ?>
                        <tbody>
                            <tr>
                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['title'];?></td>
                            <td><?php echo $row['link'];?></td>
                            <td><?php echo $row['notif'];?></td>
                            <td>
                                <button><a href="delete_notif.php?deleteid=<?php echo $id; ?>" onclick="return confirm('Are you sure?')" name='del-btn' class="fas fa-trash-alt">Delete</a></button>
                            </td>
                            </tr>
                                <?php
                                        }
                                    }else{
                                        echo '<h2 class=text-danger>Data not found</h2>';
                                    }
                                    mysqli_stmt_close($stmt);
                                    }
                                ?>
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
        <script>
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(form);
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'subscribe.php');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        alert('You have succesfully sent a notification!');
                        window.location.href = 'pushnotif.php';
                    }
                };
                xhr.send(formData);
            });
        </script>
        <script>
             const textarea = document.getElementById('notif');
            const wordCountSpan = document.querySelector('.word-count');

            textarea.addEventListener('input', function() {
            const wordCount = textarea.value.trim().split(/\s+/).length;
            wordCountSpan.textContent = wordCount   ;
            });

        </script>
    </body>
</html>
