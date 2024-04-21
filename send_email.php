<?php  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer();
if (isset($_POST['send'])) {
    

    include "connect.php";
        require "function.php";
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
    $mail->addAddress('trungndgch220848@fpt.edu.vn');

    //Content
    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];
    $mail->Body = $_POST['body'];
    //Send mail
    $mail->send();
    header('location: user.php');
    } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

else {
    try {
        include "connect.php";
        require "function.php";
        ob_start();
        include 'pages/send_email.html.php';
        $output = ob_get_clean();
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    
}
include 'pages/layout.html.php';
?>

