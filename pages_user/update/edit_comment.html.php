<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit comment</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
    session_start();
    list($user_id_logging, $userDatalogging) = getUserData($connect);
?>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <form action="../../php_users/update/edit_comment.php" method="post" enctype="multipart/form-data">
                <h1 class="text-dark">Edit comment</h1>
                <div class="form-group">
                    <label for="commentContent">Your Comment</label>
                    <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
                    <input type="text" class="form-control" id="commentContent" name="comment_content" required value="<?= $comment['comment_content'] ?>">
                </div>
                <div class="form-group">
                    <label for="commentImage">Image</label>
                    <img src="../../images/<?= $comment['image'] ?>" alt="Comment Image" class="img-fluid">
                </div>
                <div class="form-group">
                    <label for="fileToUpload">Select image to upload:</label>
                    <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
                </div>
                <input type="hidden" name='old_img' value='<?= $comment['image'] ?>'>
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
