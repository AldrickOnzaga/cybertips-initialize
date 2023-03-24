<?php

	@include 'config.php';

// Get the form data
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = md5($_POST['password']);
	$cpass = md5($_POST['cpassword']);
	$user_type = $_POST['user_type'];
	
	$select = " SELECT * FROM user_list WHERE email = '$email' && password = '$pass'";
	$result = mysqli_query($conn, $select);
	
	if(mysqli_num_rows($result) > 0){

		$error[] = 'user already exist!';
	
	}else{
	
		if($pass != $cpass){
			$error[] = 'password not matched!';
		}else{
			$insert = "INSERT INTO user_list(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
			mysqli_query($conn, $insert);
			header('location:admin.php');
		}
	}
	
	if ($conn->query($insert_personal_info) === TRUE) {
		//echo "Valid ID inserted successfully.";
        echo "<script>alert('Valid ID inserted successfully.')</script>";
        echo "<script>window.location.href = 'index.php';</script>";
        header("Location: index.php");
        exit();
	} else {
		echo "Error: " . $insert_personal_info . "<br>" . $conn->error;
	}

	mysqli_close($conn);
?>