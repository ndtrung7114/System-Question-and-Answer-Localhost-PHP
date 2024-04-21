<div class="w3-container w3-card w3-white w3-round w3-margin">
            <form action="search_module.php" method="post">
              <input type="text" class="w3-border w3-padding" name="search_module" placeholder="Filter module by name...">
              <button class="w3-button w3-theme" type="submit"><i class="fa fa-search"></i> Search</button>
            </form>
</div> 

<div class="w3-container w3-card w3-white w3-round w3-margin">
<h3><?= $searchCountmodule?> Result</h3>
</div>
<?php
    session_start();
    $user_id_logging = $_SESSION['user_id'];
    $userDatalogging = get_user_data($user_id_logging, $connect);
    
    foreach ($searchResults as $module):  ?>

  
      
        <div class="w3-container w3-card w3-white w3-round w3-margin">

        <form action="questions.php" method="post">
            <input type="hidden" name="module_id" value="<?= $module['module_id'] ?>">
            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
            <input type="submit" name='view_by_module' style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="<?= $module['module_name'] ?>"> <br><br>
            
        </form>


                
        <h6><?= $module['about'] ?></h6>
                
                
                
        </div>
    <?php endforeach; ?>