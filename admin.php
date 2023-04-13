<?php
    include_once 'config.php';
    session_start();

// Check if user is logged in
    if (!isset($_SESSION['admin_name'])) {
    // Redirect to homepage if user is not logged in
    header('location:index.php');
    exit;}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/table.css">
        <link rel="stylesheet" href="css/pop_up.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body>
        <!-- Menu -->
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
        <!-- body -->
        <div class="body">
            <h1>
                User management
            </h1>
            <button id="add-user-btn" class="btn btn-primary">Add</button>
            <script>
                document.getElementById("add-user-btn").onclick = function() {
                    document.getElementById("add-user-popup").style.display = "block";
                }
            </script>
            <div id="add-user-popup" style="display: none;">
                <h2>Add employee</h2>
                <form action="insert.php" method="post">
                    <h3>register now</h3>
                    <?php
                    if(isset($error)){
                        foreach($error as $error){
                            echo '<span class="error-msg">'.$error.'</span>';
                        };
                    };
                    ?>
                    <input type="text" name="name" required placeholder="Name">
                    <input type="email" name="email" required placeholder="Email">
                    <input type="password" name="password" required placeholder="Password">
                    <input type="password" name="cpassword" required placeholder="Enter Password again">
                    <select name="user_type">
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                    </select>
                    <input type="submit" name="submit" value="register now" class="form-btn">
                </form>
                <button onclick="document.getElementById('add-user-popup').style.display='none';">Close</button>
            </div>
            <!-- table -->
            <div class="table-container">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>User_type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                        
                        $sql = "SELECT * FROM user_list";
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
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['password'];?></td>
                            <td><?php echo $row['user_type'];?></td>
                            <td>
                                <button><a href="update.php?updateid=<?php echo $id; ?>" class="text-light">Update</a></button> |
                                <button><a href="delete.php?deleteid=<?php echo $id; ?>" onclick="return confirm('Are you sure?')" name='del-btn' class="fas fa-trash-alt">Delete</a></button>
                            </td>
                            </tr>
                            </tbody>
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
    </body>
</html>
