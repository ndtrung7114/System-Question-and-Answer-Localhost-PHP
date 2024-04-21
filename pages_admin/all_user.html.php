<?php
    session_start();
    $user_id_logging = $_SESSION['user_id'];
    $userDatalogging = get_user_data($user_id_logging, $connect);

    
    
    // include "../connect.php";
    foreach ($infors as $infor): 
      $user_id = $infor['user_id'];
      $userData = get_user_data($user_id, $connect); 

      ?>

  
      
      <div class="w3-container w3-card w3-white w3-round w3-margin">
          <br>
          <!-- Display user avatar -->
          <img src="../images/<?=$userData['avatar']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
          <!-- Display time -->
          <span class="w3-right w3-opacity"><?php echo $infor['birth']; ?></span>
          <!-- Display user name -->
          <form action="profile_user.php" method="post">
            
            <input type="hidden" name='user_id' value=<?= $user_id ?>>
            <h4><input type="submit" name="view_user" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="<?=$userData['name']?>"></h4>
            
          </form>
          <br>
          <hr class="w3-clear">
          <!-- Display infor content -->
          <p><b><?php echo $infor['reputation']; ?></b></p>
          <p><?php echo $infor['country']; ?></p>
          <p><?php echo $infor['job']; ?></p>
        
          
          
         
      </div>
    <?php endforeach; ?>