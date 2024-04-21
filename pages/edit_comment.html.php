<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
    $user_id_logging = $_SESSION['user_id'];
    $userDatalogging = get_user_data($user_id_logging, $connect);?>
    <div class="w3-container w3-card w3-white w3-round w3-margin">
<form action="edit_comment.php" method="post" enctype="multipart/form-data">
   <h1 style="color: black;">Edit comment</h1>
   <label for="">Your Comment</label>
   <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
   <input type="text" name="comment_content" required value="<?= $comment['comment_content'] ?>"><br><br>
   <img src="images/<?= $comment['image'] ?>" alt=""> <br> <br>
   Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"> <br> <br>
   <input name="edit" type="submit" value="Edit">
</form>
</div>
</body>
</html>