<?php 
include "connect.php";
session_start();
    // Get email and password from the form
    $email = $_SESSION['user_email'];
    $password = $_POST['confirm_password'];

    // Update the user's password in the database
    $sql = "UPDATE user SET password = '$password' WHERE email = '$email'";
    $update = $connect->query($sql);

    if ($update) {
        header('location: pages/register.html.php');
        exit(); // Ensure no further code is executed after redirection
    } else {
        // Handle the case where the SQL update query fails
        echo "Failed to update password.";
    }


?>