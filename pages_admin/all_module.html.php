<?php
    session_start();
    $user_id_logging = $_SESSION['user_id'];
    $userDatalogging = get_user_data($user_id_logging, $connect);?>


            

<div class="w3-container w3-card w3-white w3-round w3-margin">
        <form action="add_module.php" method="post">
        <input type="submit" value="Add Module">
        </form>

        <form action="search_module.php" method="post">
              <input type="text" class="w3-border w3-padding" name="search_module" placeholder="Filter module by name...">
              <button class="w3-button w3-theme" type="submit"><i class="fa fa-search"></i> Search</button>
            </form>
</div>  

    <?php foreach ($infor_modules as $module): ?>

      

  
      
      <div class="w3-container w3-card w3-white w3-round w3-margin">         
     

        <form action="questions.php" method="post">
            <input type="hidden" name="module_id" value="<?= $module['module_id'] ?>">
            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
            <input type="submit" name='view_by_module' style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="<?= $module['module_name'] ?>"> <br><br>
            
        </form>
      
        
                
        <h6><?= $module['about'] ?></h6>
                
                
                
       
          <form action="delete_module.php" method="post">
            <input type="hidden" name="module_id" value="<?=$module['module_id']?>">
            <input type="submit"  value='Delete' onclick="return confirm('Are you sure to delete this question ?');">
          </form>

          <form action="edit_module.php" method="post">
            <input type="hidden" name="module_id" value="<?=$module['module_id']?>">
            <input type="submit"  value='Edit'>
          </form>
            
            
          
          
      </div>
    <?php endforeach; ?>