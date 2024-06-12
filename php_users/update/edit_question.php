<?php

// UPDATE feature: edit existing data from the database
if (isset($_POST['edit'])) {
    try {
        include "../../includes/connect.php";
        require '../../includes/function.php';
        
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_FILES['fileToUpload']['name'];
        $question_id = $_POST['question_id'];
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
    

} else {
    $image = $_POST['old_img'];
}
$sql = "UPDATE question
    SET
    module_id = :module_id, 
    title = :title,
    content = :content,
    image = :image
    WHERE question_id = :question_id";
    $stm = $connect->prepare($sql);
    $stm->bindValue(":title", $_POST['title']);
    $stm->bindValue(":module_id", $_POST['module_id']);
    $stm->bindValue(":content", $_POST['content']);
    $stm->bindValue(":image", $image);
    $stm->bindValue(":question_id", $_POST['question_id']);

    $stm->execute();
    header("location: ../read/questions.php");
    

        
    } catch (PDOException $exception) {
        echo "Connect to DB failed" . $exception;
    }
} else {
    try {
        include "../../includes/connect.php";
        require '../../includes/function.php';
        $question_id = $_POST['question_id']; 
        $sql = "SELECT question.*, module.module_name 
        FROM question
        INNER JOIN module ON question.module_id = module.module_id 
        WHERE question.question_id = :question_id";
        $stm = $connect->prepare($sql);
        $stm->bindValue(":question_id", $question_id);
        $stm->execute();
        
        $question = $stm->fetch();
        $title = 'Edit Question';

        $sql_1 = 'SELECT * FROM module';
        $modules = $connect->query($sql_1);

        
        ob_start();
        include '../../pages_user/update/edit_question.html.php';
        $output = ob_get_clean();

        
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
}
include '../../pages_user/main/layout.html.php';
?>
