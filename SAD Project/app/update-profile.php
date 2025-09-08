<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

    if (isset($_POST['confirm_password']) && isset($_POST['new_password']) && isset($_POST['password']) && isset($_POST['full_name']) && $_SESSION['role'] == 'employee') {
        include "../DB_connection.php";

        function validate_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $password = validate_input($_POST['password']); // current password
        $full_name = validate_input($_POST['full_name']);
        $new_password = validate_input($_POST['new_password']);
        $confirm_password = validate_input($_POST['confirm_password']);
        $id = $_SESSION['id'];

        // Require current password always
        if (empty($password)) {
            $em = "Current password is required";
            header("Location: ../edit_profile.php?error=$em");
            exit();
        }

        include "Model/User.php";
        $user = get_user_by_id($conn, $id);

        if (!$user || !password_verify($password, $user['password'])) {
            $em = "Incorrect current password";
            header("Location: ../edit_profile.php?error=$em");
            exit();
        }

        // Validate full name (only letters + spaces)
        if (empty($full_name)) {
            $em = "Full name is required";
            header("Location: ../edit_profile.php?error=$em");
            exit();
        } else if (!preg_match("/^[A-Za-z ]+$/", $full_name)) {
            $em = "Full name must contain only letters and spaces";
            header("Location: ../edit_profile.php?error=$em");
            exit();
        }

        // Handle password update only if new password is given
        if (!empty($new_password) || !empty($confirm_password)) {
            if ($new_password !== $confirm_password) {
                $em = "New password and confirm password do not match";
                header("Location: ../edit_profile.php?error=$em");
                exit();
            }
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);
        } else {
            // Keep old password if not changing
            $new_password = $user['password'];
        }

        // Update profile
        $data = array($full_name, $new_password, $id);
        update_profile($conn, $data);

        $em = "Information changed successfully";
        header("Location: ../edit_profile.php?success=$em");
        exit();

    } else {
        $em = "Unknown error occurred";
        header("Location: ../edit_profile.php?error=$em");
        exit();
    }

} else { 
    $em = "First login";
    header("Location: ../login.php?error=$em");
    exit();
}
?>
