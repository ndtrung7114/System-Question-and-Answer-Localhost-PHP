<?php 
session_start(); 

// Assume $correct_otp is the correct OTP value retrieved from somewhere (e.g., from the session or database)

$otp_user = $_POST['otp_user'];
$otp_email = $_SESSION['otp_email'];

if ($otp_email == $otp_user ) {
    
        include 'pages/new_password.html.php';
    
} else {
    // Handle the case where the OTP values do not match
    echo "Invalid OTP.";
}
?>
