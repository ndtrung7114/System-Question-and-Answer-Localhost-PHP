<?php  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer();
try {
//Sender
$mail->SMTPDebug = 2;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'trunghack999@gmail.com';
$mail->Password = 'agcg xhso adui lsdp';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
//Recipient
$mail->addAddress($email);

//Content
$mail->isHTML(true);
$mail->Subject = 'Here is new password';
$mail->Body = $random_number;
//Send mail
$mail->send();
header('location: pages/otp.html.php');
} catch (Exception $e) {
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>

