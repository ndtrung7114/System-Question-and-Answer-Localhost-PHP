<?php
// UPDATE feature: edit existing data from the database
if (isset($_POST['edit_profile'])) {
    try {
        include "connect.php";
        require "function.php";
$valid = true;
        // Validate file upload
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$image = '';
// Check if image file is a actual image or fake image
if (!empty($_FILES['fileToUpload']['tmp_name']) && is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
    // Validate file upload
    $target_dir = "images/";
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


} else {
    // No new file uploaded, retain the old image filename
    $image = $_POST['old_avt']; // Assuming $profile is fetched from the database
}
        
        $sql = "UPDATE user
                SET name = :name,
                birth = :birth,
                job = :job,
                country = :country,
                email = :email,
                avatar = :avatar,
                user_name = :user_name,
                password = :password
                WHERE user_id = :user_id";
        $stm = $connect->prepare($sql);
        $stm->bindValue(":name", $_POST['name']);
        $stm->bindValue(":country", $_POST['country']);
        $stm->bindValue(":job", $_POST['job']);
        $stm->bindValue(":birth", $_POST['birth']);
        $stm->bindValue(":email", $_POST['email']);
        $stm->bindValue(":user_name", $_POST['user_name']);
        $stm->bindValue(":user_id", $_POST['user_id']);
        $stm->bindValue(":avatar", $image);
        $stm->bindValue(":password", $_POST['password']);

        $stm->execute();
        header("location: user.php");
    } catch (PDOException $exception) {
        echo "Connect to DB failed" . $exception;
    }
} else {
    try {
        include "connect.php";
        require "function.php";
        $user_id = $_POST['user_id']; 
        $sql = "SELECT * FROM user WHERE user_id = :user_id";
        $stm = $connect->prepare($sql);
        $stm->bindValue(":user_id", $user_id);
        $stm->execute();
        
        $profile = $stm->fetch();
        $title = 'Edit profile user';
        ob_start();
        include  'pages/edit_profile.html.php';
        $output = ob_get_clean();

        
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
}
include 'pages/layout.html.php';
?>
