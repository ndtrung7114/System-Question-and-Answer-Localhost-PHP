<?php
session_start(); // Start the session
include "../connect.php";
date_default_timezone_set('Asia/Ho_Chi_Minh');
$current_time = date('H:i:s');
$valid = true;
// Check if user_id is set in the session

    // Retrieve user_id from the session
    $user_id = $_SESSION['user_id'];

    // Retrieve form data
    $comment_content = $_POST['comment_content'];
    $id_question_comment = $_POST['question_id'];
    $date = $_POST['date'];
    $image = $_FILES["fileToUploadAnswer"]["name"];

    $image = '';

    // Check if an image file has been uploaded
    if (!empty($_FILES['fileToUploadAnswer']['tmp_name']) && is_uploaded_file($_FILES['fileToUploadAnswer']['tmp_name'])) {
        // Validate file upload
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["fileToUploadAnswer"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUploadAnswer"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            exit();
        }
    
        // Check file size
        if ($_FILES["fileToUploadAnswer"]["size"] > 500000) {
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
        if (move_uploaded_file($_FILES["fileToUploadAnswer"]["tmp_name"], $target_file)) {
            $image = basename($_FILES["fileToUploadAnswer"]["name"]);
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    }

    // Prepare and execute SQL query
    $sql = "INSERT INTO comment (user_id, question_id, comment_content, date, time, image) VALUES ('$user_id', '$id_question_comment', '$comment_content', '$date', '$current_time', '$image')";
    if ($connect->query($sql) == TRUE) {
        // Success message
        // echo "Question submitted successfully";
        // Redirect to the index page
       
        header("location: questions.php");
        exit(); // Stop script execution after redirection
    } else {
        // Error message if query execution fails
        echo "Error";}

?>
