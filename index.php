<?php
$title = 'Answer System Greenwich';
ob_start();
session_start();
if (isset($_SESSION['user_id'])) {
    require 'function.php';
include 'pages/home.html.php';
$output = ob_get_clean();
include 'pages/layout.html.php';
} else {
    echo 'Unauthorized Access';
    include 'pages/register.html.php';
}
?>
