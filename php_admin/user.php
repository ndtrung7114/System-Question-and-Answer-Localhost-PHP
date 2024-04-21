<?php

try {
    include '../connect.php';
    require '../function.php';
    
    
   

    // SQL query to check user credentials
    $sql = "SELECT * FROM user";
    $infors = $connect->query($sql);
    

    

    ob_start();
    include '../pages_admin/user.html.php';
    include '../pages_admin/all_user.html.php';   
    $output = ob_get_clean();
    
    
    


    
    
    // include "loggin.php";
} catch (PDOException $exception) {
    echo "Connect to database failed";
    $output= 'Database error: ' . $exception->getMessage();
}

include '../pages_admin/layout.html.php';
?>