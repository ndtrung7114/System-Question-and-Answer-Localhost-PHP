<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="w3-container w3-card w3-white w3-round w3-margin">
    <h3>Notification (Questions below has just been commented on)</h3>
</div>

<?php foreach ($notices as $notice): 

      $user_id = $notice['user_id'];
      $userData = get_user_data($user_id, $connect); 
      $total_comments = count_total_comment($connect, 'comment', $notice['notice_id']);
      $vote_count = count_votes_for_question($connect, $notice['notice_id'])?>
      <div class="w3-container w3-card w3-white w3-round w3-margin">
    
          <br>
          <!-- Display user avatar -->
          <img src="../../images/<?=$userData['avatar']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
          <!-- Display time -->
          <span class="w3-right w3-opacity"><?php echo $notice['date']; ?></span> <br>
          <span class="w3-right w3-opacity"><?php echo $notice['time']; ?></span>
          <!-- Display user name -->
          <h4><p style="color: #1D65CE;"><?= $userData['user_name'] ?></p></h4>
          <br>
          <hr class="w3-clear">
          <!-- Display notice content -->
          
          <form action="../../php_admin/read/view_question.php" method="post">
            <input type="hidden" name="question_id" value="<?= $notice['question_id']; ?>">
            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
            <h3><input type="submit"  style="color: #1D65CE; background: none; border: none; padding: 0; font-family: Times New Roman; cursor: pointer; text-decoration: none;" value="<?= $notice['title']; ?>"></h3> <br>
            
          </form>
         
          </div>
          <?php endforeach; ?>

</body>
</html>