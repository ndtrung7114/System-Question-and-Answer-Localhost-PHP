<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <title>Document</title>
</head>
<body>
<div class="w3-container w3-card w3-white w3-round w3-margin">
<?php
    session_start();
    list($user_id_logging, $userDatalogging) = getUserData($connect);?>
    <a href="change_password.php">Try again</a>


<?php echo 'Invalid old password'; ?>

</div>
</body>
</html>
