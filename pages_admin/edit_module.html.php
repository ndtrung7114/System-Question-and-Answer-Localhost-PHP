<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Module</title>
</head>
<body>
<?php 
    session_start();
    $user_id_logging = $_SESSION['user_id'];
    $userDatalogging = get_user_data($user_id_logging, $connect);
    ?>

<div class="w3-container w3-card w3-white w3-round w3-margin">
    
<form action="edit_module.php" method="post">
   <h1 style="color: black;">Edit module</h1>

   <label for=""> Moudle name</label>
   <input type="text" name="module_name" required value="<?= $module['module_name'] ?>"> <br><br>

  
   <input type="hidden" name="module_id" value="<?= $module['module_id'] ?>">
   <input name="edit" type="submit" value="Edit">
</form>
</div>
</body>
</html>
