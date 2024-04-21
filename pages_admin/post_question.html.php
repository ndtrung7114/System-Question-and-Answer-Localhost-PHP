<?php  
include '../connect.php';
$sql = 'SELECT * FROM module';
      $modules = $connect->query($sql);
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask Question</title>
    <link rel="stylesheet" href="../pages/css/post_question.css">
</head>
<body>
    <h2>Ask Question</h2>
    <form action="../php_admin/handle_question.php" method="post" enctype="multipart/form-data">

        

        <label for="moduleId">Module Name:</label>
        <select name="module_id" id="">
            <?php
            foreach ($modules as $module) {
            ?>
                <option value="<?= $module['module_id'] ?>"><?= $module['module_name'] ?></option>
            <?php } ?>
        </select><br><br>
        
        
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="content">What are the details of your problem?</label>
        <textarea id="content" name="content" rows="4" cols="50" required></textarea>

        
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload"> <br> <br>
            
        

        <!-- Hidden input field to capture the current date and time -->
        <input type="hidden" name="date" value="<?= date('Y-m-d') ?>">
        

    


        
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
