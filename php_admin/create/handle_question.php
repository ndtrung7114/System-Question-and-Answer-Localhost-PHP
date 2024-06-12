<?php
session_start(); // Start the session
include "../../includes/connect.php";
require "../../includes/function.php";
date_default_timezone_set('Asia/Ho_Chi_Minh');
$current_time = date('H:i:s');

// Check if user_id is set in the session

    // Retrieve user_id from the session
    $user_id = $_SESSION['user_id'];

    // Initialize validation flag
$valid = true;

// Retrieve form data
$module_id = $_POST['module_id'];
$title = $_POST['title'];
$content = $_POST['content'];
$image = $_FILES['fileToUpload']['name'];
$date = $_POST['date'];

$image = '';

// Check if an image file has been uploaded
if (!empty($_FILES['fileToUpload']['tmp_name']) && is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
    // Validate file upload
    $target_dir = "../../images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        exit();
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
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
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $image = basename($_FILES["fileToUpload"]["name"]);
    } else {
        echo "Sorry, there was an error uploading your file.";
        exit();
    }
} 
// Prepare and execute SQL query
$sql = "INSERT INTO question (user_id, module_id, title, content, date, image, time) VALUES ('$user_id', '$module_id', '$title', '$content', '$date', '$image', '$current_time')";
if ($connect->query($sql) == TRUE) {
    updateAmountQuestions($connect, $module_id, '+');
    // Success message
    // echo "Question submitted successfully";
    // Redirect to the index page
    header("location: ../read/questions.php");
    exit(); // Stop script execution after redirection
} else {
    // Error message if query execution fails
    echo "Error";
}
?>
