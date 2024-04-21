<?php
//try to delete the joke
try {
   include "connect.php";
   require "function.php";
   
   
   
   
      
   
   
   
        
        
   //connect to database (compulsory)
   
   $id_question_view = $_POST['question_id'];
   

   
   $sql_view = "SELECT question.question_id, question.user_id, user.name, user.user_name, module.module_name, question.title, question.content, question.image, question.date, question.time
   FROM question
   INNER JOIN user ON question.user_id = user.user_id 
   
   INNER JOIN module ON question.module_id = module.module_id
   
   WHERE question_id = :id_question";

    // Prepare and execute the SQL query
   $stm = $connect->prepare($sql_view);
   $stm->bindValue(':id_question', $id_question_view);
   $stm->execute();

    // Fetch the result
   
   $question = $stm->fetch(PDO::FETCH_ASSOC);
   

   $comment_view = "SELECT comment.comment_id, user.name, user.user_name, comment.user_id, comment.comment_content, comment.date, comment.time, comment.image
   FROM comment
   INNER JOIN user 
   ON comment.user_id = user.user_id
   
   WHERE question_id = :id_question
   ORDER BY comment.date DESC, comment.time DESC";

    // Prepare and execute the SQL query
   $stm_comment = $connect->prepare($comment_view);
   $stm_comment->bindValue(':id_question', $id_question_view);
   $stm_comment->execute();


    // Fetch the result
   
   $comments = $stm_comment->fetchALL(PDO::FETCH_ASSOC);



   
   ob_start();
   
   include 'pages/view_question.html.php';
   $output = ob_get_clean();
   
}
//catch the error if deleting joke failed
catch (PDOException $exception) {
   //show error here
   echo "Select question failed. Error: " . $exception;
}
include 'pages/layout.html.php';
?>