<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit comment reply</title>
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
            <form action="../../php_admin/update/edit_comment_rep.php" method="post" enctype="multipart/form-data">
                <h1 class="text-dark">Edit comment reply</h1>
                <div class="form-group">
                    <label for="commentRepContent">Your Comment</label>
                    <input type="hidden" name="comment_rep_id" value="<?= $comment_rep['comment_rep_id'] ?>">
                    <input type="text" class="form-control" id="commentRepContent" name="comment_rep_content" required value="<?= $comment_rep['content'] ?>">
                </div>
                <div class="form-group">
                    <label for="commentRepImage">Image</label>
                    <img src="../../images/<?= $comment_rep['image'] ?>" alt="Comment Reply Image" class="img-fluid">
                </div>
                <div class="form-group">
                    <label for="fileToUpload">Select image to upload:</label>
                    <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
                </div>
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
