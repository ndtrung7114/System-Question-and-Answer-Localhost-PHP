<?php
    session_start();
    list($user_id_logging, $userDatalogging) = getUserData($connect);?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Mysql PDO AutoComplete Search with Jquery Ajax</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    input {
      border-radius: 10px;
    }
  </style>
</head>
<body class="bg-warning">

<div class="w3-container w3-card w3-white w3-round w3-margin">
  <br>
<form action="../../php_admin/create/add_module.php" method="post">
          <input type="submit" class="w3-button w3-theme" value="Add Module"> 
        </form>
    <div class="row mt-4">
      
      
      
        <form action="../../php_admin/read/search_module.php" method="post">
        <div class="input-group mb-3">
          
          <input type="text" class="form-control" name="search_module" id="search" placeholder="Filer by name..." aria-describedby="basic-addon2" autocomplete="off">
          <button class="btn btn-outline-secondary" type="submit" name="submit" id="basic-addon22">Search</button>
        </div><br>
        </form>              
        <div class="card list-group" id="show-list"></div>  
        
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="../../script.js"></script>
<script>

  function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }
// Call the searchFunction with appropriate parameters
searchFunction("#search", "../read/complete_search_module.php");
</script>

<div class="w3-container w3-card w3-white w3-round w3-margin">
  <br>
    
        <form action="../../php_admin/read/search_module.php" method="post">
        
        <input type="submit" class="w3-button w3-theme" name="popular" value="Popular"> 
        
        <input type="submit" class="w3-button w3-theme" name="name_module" value="Name (a-z)">
     
        </form>              
         <br>
    
</div>

<?php foreach ($infor_modules as $module): 
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
        
        <h6 style='font-family: Times New Roman;'><?= $amount_question ?> questions</h6> <br>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="questionDropdown<?= $module['module_id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="questionDropdown<?= $module['module_id'] ?>">
                        <form action="../delete/delete_module.php" method="post">
                          <input type="hidden" name="module_id" value="<?=$module['module_id']?>">
                          <input type="submit" class="w3-button w3-theme" value='Delete' onclick="return confirm('Are you sure to delete this question ?');">
                        </form> <br>

                        <form action="../update/edit_module.php" method="post">
                          <input type="hidden" name="module_id" value="<?=$module['module_id']?>">
                          <input type="submit" class="w3-button w3-theme" value='Edit'>
                        </form><br>

</div>
</div><br>
                      
        
        
                
                
                
        </div>
    <?php endforeach; ?>

    <script>
    // Get dropdown buttons and menus for each dropdown
    var questionDropdownButtons = document.querySelectorAll('.dropdown-toggle');
    var questionDropdownMenus = document.querySelectorAll('.dropdown-menu');

    // Iterate over each dropdown button
    questionDropdownButtons.forEach(function(button, index) {
        // Add click event listener to each dropdown button
        button.addEventListener('click', function() {
            // Get the corresponding dropdown menu based on index
            var dropdownMenu = questionDropdownMenus[index];

            // Toggle the 'show' class on the corresponding dropdown menu
            dropdownMenu.classList.toggle('show');
        });
    });
</script>


</body>
</html>
