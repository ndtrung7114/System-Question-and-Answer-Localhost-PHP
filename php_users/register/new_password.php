<?php 
include "../../includes/connect.php";
require '../../includes/function.php';
session_start();
    // Get email and password from the form
    $email = $_SESSION['user_email'];
    $password = $_POST['confirm_password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $sql = "UPDATE user SET password = '$hashed_password' WHERE email = '$email'";
    $update = $connect->query($sql);

    if ($update) {
        header('location: ../../pages_user/register/register.html.php');
        exit(); // Ensure no further code is executed after redirection
    } else {
        // Handle the case where the SQL update query fails
        echo "Failed to update password.";
    }


?>