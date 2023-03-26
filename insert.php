<?php
	@include 'config.php';

	// Get the form data
	$name = $_POST['name'];
	$email = $_POST['email'];
	$pass = md5($_POST['password']);
	$cpass = md5($_POST['cpassword']);
	$user_type = $_POST['user_type'];

    // Validate input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Invalid email format';
    }
    if (strlen($password) < 8) {
        $error[] = 'Password must be at least 8 characters long';
    }
    if ($password !== $confirm_password) {
        $error[] = 'Passwords do not match';
    }

    // Check if user already exists
    $stmt = $conn->prepare("SELECT * FROM user_list WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error[] = 'User already exists';
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO user_list(name, email, password, user_type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $user_type);
        $stmt->execute();
        header('location: admin.php');
        exit();
    }

	$conn->close();
?>
