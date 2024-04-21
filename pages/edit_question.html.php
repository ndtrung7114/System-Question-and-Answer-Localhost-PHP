<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="w3-container w3-card w3-white w3-round w3-margin">
    <?php 
    session_start();
    $user_id_logging = $_SESSION['user_id'];
    $userDatalogging = get_user_data($user_id_logging, $connect);
    ?>
<form action="edit_question.php" method="post" enctype="multipart/form-data">
   <h1 style="color: black;">Edit Question</h1>

   
   <label for="moduleId">Module Name:</label>
        <select name="module_id" id="">
            <?php
            // Display the module belonging to the question first
            echo '<option value="' . $question['module_id'] . '">' . $question['module_name'] . '</option>';

            // Then display the rest of the modules
            foreach ($modules as $module) {
                // Skip the module belonging to the question
                if ($module['module_id'] == $question['module_id']) {
                    continue;
                }
            ?>
                <option value="<?= $module['module_id'] ?>"><?= $module['module_name'] ?></option>
            <?php } ?>
    </select><br><br>
   <label for="">Title</label>
   <input type="text" name="title" required value="<?= $question['title'] ?>"><br><br>
   <label for="">Content</label>
   <input type="text" name="content" required value="<?= $question['content'] ?>"><br><br>
   <label for="">Image</label>
   <img src="images/<?= $question['image'] ?>" alt=""> <br> <br>
   Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"> <br> <br>
   <input type="hidden" name="question_id" value="<?= $question['question_id'] ?>">
   <input name="edit" type="submit" value="Edit">
</form>
</div>
</body>
</html>
