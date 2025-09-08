<?php 
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['id'])){

if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['full_name']) && $_SESSION['role'] == 'admin') {
	include "../DB_connection.php";

    function validate_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$user_name = validate_input($_POST['user_name']);
	$password = validate_input($_POST['password']);
    $full_name = validate_input($_POST['full_name']);
    $id = validate_input($_POST['id']);

	if (empty($user_name)) {
		$em = "User name is required";
	    header("Location: ../edit-user.php?error=$em&id=$id");
	    exit();
	}else if (empty($password)) {
		$em = "Password is required";
	    header("Location: ../edit-user.php?error=$em&id=$id");
	    exit();
	}else if (empty($full_name)) {
		$em = "Full name is required";
	    header("Location: ../edit-user.php?error=$em&id=$id");
	    exit();
	}

		// Full Name: letters and spaces only
        if (!preg_match("/^[A-Za-z\s]+$/", $full_name)) {
            $em = "Full Name must only contain letters and spaces";
            header("Location: ../edit-user.php?error=$em&id=$id");
            exit();
        }

        // Username: must contain at least one letter, can include numbers, min 3 chars
        if (!preg_match("/^(?=.*[A-Za-z])[A-Za-z0-9]{3,}$/", $user_name)) {
            $em = "Username must be at least 3 characters, contain letters, and may include numbers (numbers only not allowed)";
            header("Location: ../edit-user.php?error=$em&id=$id");
            exit();
        }

        // Password: minimum 6 characters
        if (strlen($password) < 6) {
            $em = "Password must be at least 6 characters long";
            header("Location: ../edit-user.php?error=$em&id=$id");
            exit();
        }
    
       include "Model/User.php";
       $password = password_hash($password, PASSWORD_DEFAULT);
       $data = array($full_name, $user_name, $password, "employee", $id, "employee");
       update_user($conn, $data);

        $em = "Information updated successfully";
	    header("Location: ../edit-user.php?success=$em&id=$id");
	    exit();

	} else {
   $em = "Unknown error occurred";
   header("Location: ../edit-user.php?error=$em");
   exit();
}

}else{ 
	$em = "First login";
   	header("Location: ../edit-user.php?error=$em");
   	exit();
}