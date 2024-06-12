<?php
// Check if the form is submitted for editing
if (isset($_POST['edit'])) {
    try {
        // Include the database connection
        include "../../includes/connect.php";
        require '../../includes/function.php';
        $comment_id = $_POST['comment_id'];

        $image = '';
        
        $valid = true;
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
        
        // Prepare the SQL query to update the comment
        $sql = "UPDATE comment SET comment_content = :comment_content, image = :image
                WHERE comment_id = :comment_id";
        $stm = $connect->prepare($sql);
        
        // Bind parameters
        $stm->bindValue(":comment_content", $_POST['comment_content']);
        $stm->bindValue(":image", $image);
        $stm->bindValue(":comment_id", $_POST['comment_id']);

        // Execute the update query
        $stm->execute();
        
        // Redirect back to the index page or wherever you want
        header("location: ../read/questions.php");

        exit(); // Exit to prevent further execution
    } catch (PDOException $exception) {
        // Handle any database errors
        echo "Database error: " . $exception->getMessage();
    }
} else {
    // If the form is not submitted for editing, load the comment data
    try {
        // Include the database connection
        include "../../includes/connect.php";
        require '../../includes/function.php';
        // Get the comment ID from the form
        $comment_id = $_POST['comment_id']; 
        
        // Prepare and execute the SQL query to fetch the comment data
        $sql = "SELECT * FROM comment WHERE comment_id = :comment_id";
        $stm = $connect->prepare($sql);
        $stm->bindValue(":comment_id", $_POST['comment_id']);
        $stm->execute();
        
        // Fetch the comment data
        $comment = $stm->fetch();
        
        // Set the title (optional)
        $title = 'Edit comment';
        ob_start();
        // Include the HTML form for editing the comment
        include  '../../pages_user/update/edit_comment.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        // Handle any database errors
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
}
include '../../pages_user/main/layout.html.php';
?>
