
<?php foreach ($comments as $comment): 
    $userDatalogging = get_user_data($comment['user_id'], $connect);?>
    <div class="w3-container w3-card w3-white w3-round w3-margin">
    <form action="view_question.php" method="post">
        
            
        <input type="hidden" name="question_id" value="<?= $comment['question_id'] ?>">

        <input type="submit" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="<?= $comment['comment_content'] ?>"> answered by <?= $userDatalogging['name'] ?> <br><br>
        
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
          <img src="images/<?=$userData['avatar']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
          <!-- Display time -->
          <span class="w3-right w3-opacity"><?php echo $question['date']; ?></span> <br>
          <span class="w3-right w3-opacity"><?php echo $question['time']; ?></span>
          <!-- Display user name -->
          <h4><?php echo $userData['name']; ?></h4>
          <br>
          <hr class="w3-clear">
          <!-- Display question content -->
          <p><b><?php echo $question['title']; ?></b></p>
          <form action="view_question.php" method="post">
            <input type="hidden" name="question_id" value="<?= $question['question_id']; ?>">
            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
            <input type="submit" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="<?= $question['content']; ?>"> <br><br>
            
          </form>
          
        
          <!-- Like, Edit, and Delete buttons -->
          
          
          

          <!-- Like and Comment buttons -->
          <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i> Vote (<?= $vote_count ?>)</button> 
          <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom" ><i class="fa fa-eye"></i> View (<?= $question['view'] ?>)</button>
          
          <button type="submit" class="w3-button w3-theme-d2 w3-margin-bottom" ><i class="fa fa-comment"></i> Answer (<?= $total_comments ?>) </button>
          
          
         
      </div>
    <?php endforeach; ?>