<?php  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
$mail = new PHPMailer();
if (isset($_POST['send'])) {
    

    include "../../includes/connect.php";
        require "../../includes/function.php";
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
    $mail->Body = 'From: ' . $_POST['from']   . '<br>' . $_POST['body'];
    //Send mail
    $mail->send();
    header('location: ../create/send_email.php');
    } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

else {
    try {
        include "../../includes/connect.php";
        require '../../includes/function.php';
        session_start();
     
       
        $sql = "SELECT email FROM user ";
        $emails = $connect->query($sql);
        
        
        
        ob_start();
        include '../../pages_user/create/send_email.html.php';
        $output = ob_get_clean();
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    
}
include '../../pages_user/main/layout.html.php';
?>

