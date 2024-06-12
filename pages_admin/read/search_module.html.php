<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <title>Document</title>
    <style>
        input {
      border-radius: 10px;
    }
    </style>
</head>

<body>
<div class="w3-container w3-card w3-white w3-round w3-margin">
    <div class="row mt-4">
        <form action="../../php_admin/read/search_module.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="search_module" id="search" placeholder="Filer by name..." aria-describedby="basic-addon2" autocomplete="off">
          <button class="btn btn-outline-secondary" type="submit" name="submit" id="basic-addon22">Search</button>
        </div>
        </form>              
        <div class="card list-group" id="show-list"></div>  
    </div>
</div> 

<div class="w3-container w3-card w3-white w3-round w3-margin">
    
        <form action="../../php_admin/read/search_module.php" method="post">
        
        <input type="submit" class="w3-button w3-theme" name="popular" value="Popular"> 
        
        <input type="submit" class="w3-button w3-theme" name="name_module" value="Name (a-z)">
     
        </form>              
         
    
</div>


    <div class="w3-container w3-card w3-white w3-round w3-margin">
    <h3><?= $searchCountmodule?> Result</h3>
    </div>
    <?php
        session_start();
        list($user_id_logging, $userDatalogging) = getUserData($connect);;
        
        foreach ($searchResults as $module): 

        $amount_question = countQuestionsByModuleId($connect, $module['module_id']);?>
        <div class="w3-container w3-card w3-white w3-round w3-margin">
        <br>

        <form action="../../php_admin/read/questions.php" method="post">
            <input type="hidden" name="module_id" value="<?= $module['module_id'] ?>">
            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
            <input type="submit" name='view_by_module' style="font-family: Times New Roman; font-size: 24px; color: #1D65CE; background-color: #BAD0F0; border: 0; border-radius: 10px;" value="<?= $module['module_name'] ?>"> <br><br>
            
        </form>
      
        
        <h4 style='font-family: Times New Roman;'><?= $module['about'] ?></h4>
        <br>
        
        <h6 style='font-family: Times New Roman;'><?= $amount_question ?> questions</h6> 
            
            
            
    </div>
<?php endforeach; ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="../../script.js"></script>
<script>
// Call the searchFunction with appropriate parameters
searchFunction("#search", "../read/complete_search_module.php");
</script>
</body>
</html>







    
