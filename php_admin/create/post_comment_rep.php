<?php
session_start(); // Start the session
include "../../includes/connect.php";
require "../../includes/function.php";
date_default_timezone_set('Asia/Ho_Chi_Minh');
$current_time = date('H:i:s');
$valid = true;
// Check if user_id is set in the session

    // Retrieve user_id from the session
    $user_id = $_SESSION['user_id'];
    $comment_id = $_POST['comment_id'];
    $user_id_question = $_POST['user_id_question'];
    // Retrieve form data
    $content = $_POST['comment_rep_content'];
    $id_question_comment = $_POST['question_id'];
    $date = $_POST['date'];
    $image = $_FILES["fileToUploadRep"]["name"];

    $image = '';

    // Check if an image file has been uploaded
    if (!empty($_FILES['fileToUploadRep']['tmp_name']) && is_uploaded_file($_FILES['fileToUploadRep']['tmp_name'])) {
        // Validate file upload
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUploadRep"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUploadRep"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            exit();
        }
    
        // Check file size
        if ($_FILES["fileToUploadRep"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            exit();
        }
    
        // Allow certain file formats
        if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            exit();
        }
    
        // If everything is valid, move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES["fileToUploadRep"]["tmp_name"], $target_file)) {
            $image = basename($_FILES["fileToUploadRep"]["name"]);
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } 
    $sql_check = "SELECT COUNT(*) as count FROM notification WHERE user_id = :user_id AND question_id = :question_id";
    $stmt_check = $connect->prepare($sql_check);
    $stmt_check->bindParam(':user_id', $user_id_question);
    $stmt_check->bindParam(':question_id', $id_question_comment);
    $stmt_check->execute();
    $row = $stmt_check->fetch();
    $count = $row['count'];
    
    if ($count > 0) {
        // If a row exists, update the activate column to 1
        $sql_update = "UPDATE notification SET activate = 1 WHERE user_id = :user_id AND question_id = :question_id";
        $stmt_update = $connect->prepare($sql_update);
        $stmt_update->bindParam(':user_id', $user_id_question);
        $stmt_update->bindParam(':question_id', $id_question_comment);
        $stmt_update->execute();
    } else {
        // If no row exists, insert a new row
        $sql_insert = "INSERT INTO notification (user_id, question_id, activate, date, time) 
                       VALUES (:user_id, :question_id, 1, :date, :time)";
        $stmt_insert = $connect->prepare($sql_insert);
        $stmt_insert->bindParam(':user_id', $user_id_question);
        $stmt_insert->bindParam(':question_id', $id_question_comment);
        $stmt_insert->bindParam(':date', $date);
        $stmt_insert->bindParam(':time', $current_time);
        $stmt_insert->execute();
    }

    // Prepare and execute SQL query
    $sql = "INSERT INTO comment_rep (user_id, comment_id, question_id, content, date, time, image) VALUES ('$user_id', '$comment_id', '$id_question_comment', '$content', '$date', '$current_time', '$image')";
    if ($connect->query($sql) == TRUE) {
        // Success message
        // echo "Question submitted successfully";
        // Redirect to the index page
       
        header("location: ../read/questions.php");
        exit(); // Stop script execution after redirection
    } else {
        // Error message if query execution fails
        echo "Error";}

?>
