<?php
    session_start();
    $user_id_logging = $_SESSION['user_id'];
    $userDatalogging = get_user_data($user_id_logging, $connect);?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Mysql PDO AutoComplete Search with Jquery Ajax</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    
</head>
<body class="bg-warning">

<div class="w3-container w3-card w3-white w3-round w3-margin">
    <div class="row mt-4">
        <form action="search_module.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="search_module" id="search" placeholder="Filer by name..." aria-describedby="basic-addon2" autocomplete="off">
          <button class="btn btn-outline-secondary" type="submit" name="submit" id="basic-addon22">Search</button>
        </div>
        </form>              
        <div class="card list-group" id="show-list"></div>  
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="script.js"></script>
<script>
// Call the searchFunction with appropriate parameters
searchFunction("#search", "complete_search_module.php");
</script>
<?php foreach ($infor_modules as $module): ?>
        <div class="w3-container w3-card w3-white w3-round w3-margin">

        <form action="questions.php" method="post">
            <input type="hidden" name="module_id" value="<?= $module['module_id'] ?>">
            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
            <input type="submit" name='view_by_module' style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="<?= $module['module_name'] ?>"> <br><br>
            
        </form>
      
        
                
        <h6><?= $module['about'] ?></h6>
                
                
                
        </div>
    <?php endforeach; ?>

</body>
</html>

    

   


