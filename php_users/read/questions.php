<?php

if (isset($_POST['view_by_module'])) {
    try {
        include "../../includes/connect.php";
        require '../../includes/function.php';
        $module_id = $_POST['module_id'];
        
       
    
        // SQL query to check user credentials
       

     
        $sql_order = "SELECT question.*, module.module_name 
              FROM question 
              INNER JOIN module ON question.module_id = module.module_id 
              WHERE question.module_id = $module_id
              ORDER BY question.date DESC, question.time DESC";

        $question_order = $connect->query($sql_order);
    
        // Count the number of questions
        $num_questions = $question_order->rowCount(); 
    
        ob_start();
        include '../../pages_user/read/questions.html.php';  
        $output = ob_get_clean();
        
        
    
    
        
        
        // include "loggin.php";
    } catch (PDOException $exception) {
        echo "Connect to database failed";
        $output= 'Database error: ' . $exception->getMessage();
    }
} else {
    try {
        include "../../includes/connect.php";
        require '../../includes/function.php';
        
        
        $sql_1 = "SELECT *
              FROM module"
              ;

        $modules = $connect->query($sql_1);
    
        // SQL query to check user credentials
        $sql = "SELECT * FROM user";
        $infor = $connect->query($sql);
        $sql1 = "SELECT * FROM question";
        $questions = $connect->query($sql1);
        $sql_order = "SELECT question.*, module.module_name 
              FROM question 
              INNER JOIN module ON question.module_id = module.module_id 
              ORDER BY question.date DESC, question.time DESC";
        $question_order = $connect->query($sql_order);
    
        // Count the number of questions
        $num_questions = $question_order->rowCount();
    
        ob_start();
        include '../../pages_user/read/questions.html.php';  
        $output = ob_get_clean();
        
        
    
    
        
        
        // include "loggin.php";
    } catch (PDOException $exception) {
        echo "Connect to database failed";
        $output= 'Database error: ' . $exception->getMessage();
    }
}



include '../../pages_user/main/layout.html.php';
?>