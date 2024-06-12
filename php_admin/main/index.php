<?php
$title = 'Answer System Greenwich';
ob_start();
session_start();
if (isset($_SESSION['user_id'])) {
    require '../../includes/function.php';
include '../../pages_admin/main/home.html.php';
$output = ob_get_clean();
include '../../pages_admin/main/layout.html.php';
} else {
    echo 'Unauthorized Access';
    include '../../pages_user/register/register.html.php';
}
?>
