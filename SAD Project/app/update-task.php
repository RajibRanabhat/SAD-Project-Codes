<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['assigned_to']) && $_SESSION['role'] == 'admin' && isset($_POST['due_date'])) {
	include "../DB_connection.php";

    function validate_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$title = validate_input($_POST['title']);
	$description = validate_input($_POST['description']);
	$assigned_to = validate_input($_POST['assigned_to']);
	$id = validate_input($_POST['id']);
	$due_date = validate_input($_POST['due_date']);

	if (empty($title)) {
		$em = "Title is required";
	    header("Location: ../edit-task.php?error=$em&id=$id");
	    exit();
	}else if (empty($description)) {
		$em = "Description is required";
	    header("Location: ../edit-task.php?error=$em&id=$id");
	    exit();
	}else if ($assigned_to == 0) {
		$em = "Select User";
	    header("Location: ../edit-task.php?error=$em&id=$id");
	    exit();
	}

		// Title: must contain at least one letter, can include numbers and spaces
        if (!preg_match("/^(?=.*[A-Za-z])[A-Za-z0-9\s\.\,\-\'\"\(\)]+$/", $title)) {
            $em = "Title must contain letters and may include numbers and spaces (numbers only not allowed)";
            header("Location: ../create_task.php?error=$em");
            exit();
        }

        // Description: must contain at least one letter, can include numbers and spaces, minimum 10 characters
		if (!preg_match("/^(?=.*[A-Za-z])[A-Za-z0-9\s\.\,\-\'\"\(\)]{10,}$/", $description)) {
			$em = "Description must contain letters and may include numbers and spaces (minimum 10 characters and numbers only not allowed)";
			header("Location: ../create_task.php?error=$em");
			exit();
		}
    
       include "Model/Task.php";

       $data = array($title, $description, $assigned_to, $due_date, $id);
       update_task($conn, $data);

       $em = "Task updated successfully";
	    header("Location: ../edit-task.php?success=$em&id=$id");
	    exit();

    
}else {
   $em = "Unknown error occurred";
   header("Location: ../edit-task.php?error=$em");
   exit();
}

}else{ 
   $em = "First login";
   header("Location: ../login.php?error=$em");
   exit();
}