<?php
session_start();

@include_once 'config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['user_type'] !== 'admin') {
    die("Access denied");
}

if(isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if($id === false || empty($description)){
        die("Invalid input data");
    }

    $stmt = $conn->prepare("UPDATE cm SET description = ? WHERE id = ?");
    $stmt->bind_param("si", $description, $id);

    if($stmt->execute()){
        header('location:admin.php');
    }else{
        die(mysqli_error($conn));
    }
}

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if($id === false){
        die("Invalid input data");
    }

    $stmt = $conn->prepare("SELECT * FROM cm WHERE id = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        $result = $stmt->get_result();

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();

            $id = $row['id'];
            $description = $row['description'];
            $image = $row['img'];
        }else{
            die("Invalid input data");
        }
    }else{
        die(mysqli_error($conn));
    }
}else{
    die("Invalid input data");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update CM</title>
</head>
<body>

<h2>Update CM</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" maxlength="100" required><?php echo $description; ?></textarea>

    <button type="submit" name="submit">Update</button>
</form>

</body>
</html>
