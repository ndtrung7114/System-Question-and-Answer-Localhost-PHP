<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<div class="w3-container w3-card w3-white w3-round w3-margin">
  <h3>Saved List</h3>
</div>
<?php foreach ($comments as $comment): 
    $userDatalogging = get_user_data($comment['user_id'], $connect);?>
    <div class="w3-container w3-card w3-white w3-round w3-margin">
      <br>
    <form action="../../php_users/read/view_question.php" method="post">
    <span class="w3-right w3-opacity"><?php echo $comment['date']; ?></span> <br>
          <span class="w3-right w3-opacity"><?php echo $comment['time']; ?></span>    
            
        <input type="hidden" name="question_id" value="<?= $comment['question_id'] ?>">

        <h4><input type="submit" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="<?= $comment['comment_content'] ?>"></h4> <br> answered by<h6><b><?= $userDatalogging['user_name'] ?></b></h6> <br>
        
    </form>
</div>
<?php endforeach; ?>
<?php
    
    $user_id_logging = $_SESSION['user_id'];
    $userDatalogging = get_user_data($user_id_logging, $connect);
foreach ($questions as $question): 
      $user_id = $question['user_id'];
      $userData = get_user_data($user_id, $connect); 
      $total_comments = count_total_comment($connect, 'comment', $question['question_id']);
      $vote_count = count_votes_for_question($connect, $question['question_id'])?>
      
      <div class="w3-container w3-card w3-white w3-round w3-margin">
          <br>
          <!-- Display user avatar -->
          <img src="../../images/<?=$userData['avatar']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
          <!-- Display time -->
          <span class="w3-right w3-opacity"><?php echo $question['date']; ?></span> <br>
          <span class="w3-right w3-opacity"><?php echo $question['time']; ?></span>
          <!-- Display user name -->
          <h4><p style="color: #1D65CE;"><?= $userData['user_name'] ?></p></h4>
          <br>
          <hr class="w3-clear">
          <!-- Display question content -->
          
          <form action="../../php_users/read/view_question.php" method="post">
            <input type="hidden" name="question_id" value="<?= $question['question_id']; ?>">
            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
            <h3><input type="submit"  style="color: #1D65CE; background: none; border: none; padding: 0; font-family: Times New Roman; cursor: pointer; text-decoration: none;" value="<?= $question['title']; ?>"></h3> <br>
            
          </form>
          <h5><p style="font-family: Times New Roman"><?php echo $question['content']; ?></p></h5><br>

          <form action="../../php_users/read/search_module.php" method='post'>
            <input type="hidden" name='module_id' value="<?= $question['module_id'] ?> ">
            <h6> <input style="font-family: Times New Roman; color: #1D65CE; background-color: #BAD0F0; border: 0; border-radius: 10px;" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Click to see details"  type="submit" name='search_from_question'  value="<?= $question['module_name'] ?>"> </h6><br>
            
          </form>
          
        
          <!-- Like, Edit, and Delete buttons -->
          
          
          

          <!-- Like and Comment buttons -->
          <button type="button" style="border-radius: 10px;" class="w3-button w3-theme-d2 w3-margin-bottom" title="Score of <?= $vote_count ?> "><i class="fa fa-thumbs-up"></i> Vote (<?= $vote_count ?>)</button> 
          <button type="button" style="border-radius: 10px;" class="w3-button w3-theme-d2 w3-margin-bottom" title="<?= $question['view'] ?> views"><i class="fa fa-eye"></i> View (<?= $question['view'] ?>)</button>
          
          <button type="submit" style="border-radius: 10px;" class="w3-button w3-theme-d2 w3-margin-bottom" title='<?= $total_comments ?> ' ><i class="fa fa-comment"></i> Answer (<?= $total_comments ?>) </button>
          
          
         
      </div>
    <?php endforeach; ?>
</body>
</html>
