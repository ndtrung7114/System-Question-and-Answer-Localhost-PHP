<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <title>Home</title>
</head>
<body>
<div class="w3-container w3-card w3-white w3-round w3-margin" >
<h2>Answer Question Greenwich</h2>
<p>Welcome to the Answer Question Greenwich, this is version for user</p>

</div>
<?php
$user_id_logging = $_SESSION['user_id'];
$userDatalogging = get_user_data($user_id_logging, $connect);
 ?>
</body>
</html>
