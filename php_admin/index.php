<?php
$title = 'Answer System Greenwich (Admin)';
ob_start();
session_start();
require '../function.php';
include '../pages_admin/home.html.php';
$output = ob_get_clean();
include '../pages_admin/layout.html.php';