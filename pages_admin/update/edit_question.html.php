<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
    
</head>
<body>
<div class="w3-container w3-card w3-white w3-round w3-margin">
<div class="container mt-5">
    <?php 
    session_start();
    list($user_id_logging, $userDatalogging) = getUserData($connect);
    ?>
    <form action="../../php_admin/update/edit_question.php" method="post" enctype="multipart/form-data">
        <h1>Edit Question</h1>

        <div class="form-group">
            <label for="moduleId">Module Name:</label>
            <select class="form-control" name="module_id" id="moduleId">
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
            </select>
        </div>

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" name="title" id="title" required value="<?= $question['title'] ?>">
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <input type="text" class="form-control" name="content" id="content" required value="<?= $question['content'] ?>">
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <img src="../../images/<?= $question['image'] ?>" alt="Question Image">
        </div>

        <div class="form-group">
            <label for="fileToUpload">Select image to upload:</label>
            <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
        </div>

        <input type="hidden" name="question_id" value="<?= $question['question_id'] ?>">
        <button type="submit" name="edit" class="btn btn-primary">Edit</button>
    </form>
</div>
</div>

</body>
</html>
