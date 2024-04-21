<?php

try {
    include '../connect.php';
    require '../function.php';
    
    
   

    // SQL query to check user credentials
    $sql = "SELECT * FROM module";
    $infor_modules = $connect->query($sql);
    

    

    ob_start();
    include '../pages_admin/all_module.html.php';   
    $output = ob_get_clean();
    
    
    


    
    
    // include "loggin.php";
} catch (PDOException $exception) {
    echo "Connect to database failed";
    $output= 'Database error: ' . $exception->getMessage();
}

include '../pages_admin/layout.html.php';
?>