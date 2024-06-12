<?php

try {
    include "../../includes/connect.php";
    require '../../includes/function.php';
    
    
   

    // SQL query to check user credentials
    $sql = "SELECT * FROM module";
    $infor_modules = $connect->query($sql);
    

    

    ob_start();
    include '../../pages_admin/read/all_module.html.php';   
    $output = ob_get_clean();
    
    
    


    
    
    // include "loggin.php";
} catch (PDOException $exception) {
    echo "Connect to database failed";
    $output= 'Database error: ' . $exception->getMessage();
}

include '../../pages_admin/main/layout.html.php';
?>