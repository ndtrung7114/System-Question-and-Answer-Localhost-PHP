<?php


    try {
        include "../../includes/connect.php";
        require '../../includes/function.php';
        session_start();
        $user_id_logging = $_SESSION['user_id'];
        $userDatalogging = get_user_data($user_id_logging, $connect);
        $user_id = $_POST['user_id'];
        
        $sql = "SELECT * FROM user WHERE user_id = :user_id"; // Using prepared statement to prevent SQL injection
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $infors = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $sql_1 = "SELECT * FROM comment WHERE user_id = :user_id"; // Using prepared statement to prevent SQL injection
        $sql_user_comment = $connect->prepare($sql_1);
        $sql_user_comment->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sql_user_comment->execute();
        $count_user_comment = $sql_user_comment->rowCount();
    
        $sql_2 = "SELECT * FROM question WHERE user_id = :user_id"; // Using prepared statement to prevent SQL injection
        $sql_user_question = $connect->prepare($sql_2);
        $sql_user_question->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sql_user_question->execute();
        $count_user_question = $sql_user_question->rowCount();

        
    
        ob_start();
        include '../../pages_user/read/profile_user.html.php';  
        $output = ob_get_clean();
        
        
    
    
        
        
        // include "loggin.php";
    } catch (PDOException $exception) {
        echo "Connect to database failed";
        $output= 'Database error: ' . $exception->getMessage();
    }
    
    include '../../pages_user/main/layout.html.php';
    



?>