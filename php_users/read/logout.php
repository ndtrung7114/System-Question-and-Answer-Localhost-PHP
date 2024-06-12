<?php 
session_start();
unset($_SESSION['user_id']);
session_destroy();
header('location: ../../pages_user/register/register.html.php');
 ?>