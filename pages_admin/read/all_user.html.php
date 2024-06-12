<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
  <title>Document</title>
</head>
<body>
<?php
    session_start();
    list($user_id_logging, $userDatalogging) = getUserData($connect);;

    
    
    // include "../connect.php";
    foreach ($infors as $infor): 
      $user_id = $infor['user_id'];
      $userData = get_user_data($user_id, $connect); 
      $day_creation = elapsedTimeSinceCreation($infor['create_at'])

      ?>

  
      
      <div class="w3-container w3-card w3-white w3-round w3-margin">
          <br>
          <!-- Display user avatar -->
          <img src="../../images/<?=$userData['avatar']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
          <!-- Display time -->
          <span class="w3-right w3-opacity"><i class="fa-solid fa-cake-candles"></i>  <?php echo $infor['birth']; ?></span>
          <!-- Display user name -->
          <form action="profile_user.php" method="post">
            
            <input type="hidden" name='user_id' value=<?= $user_id ?>>
            <h4><input type="submit" name="view_user" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="<?=$userData['user_name']?>"></h4>
            
          </form>
          <br>
          <hr class="w3-clear">
          <!-- Display infor content -->
          <p><b><?php echo $infor['reputation']; ?></b></p>
          <p><?php echo $infor['country']; ?></p>
          <p><?php echo $infor['job']; ?></p>
          <p>Member for <?= $day_creation ?> </p>
        
          
          
         
      </div>
    <?php endforeach; ?>
</body>
</html>
