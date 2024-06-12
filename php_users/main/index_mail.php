<?php
//1st case: display the form for user to send email
if (!isset($_POST['reset'])) {
   include '../../pages_user/register/reset_password.html.php';
} else {
   session_start();
            
   $email = $_POST['email'];
   $_SESSION['user_email'] = $email;

   $random_number = $_POST['otp_email'];
   include '../register/reset_password.php';
}
?>