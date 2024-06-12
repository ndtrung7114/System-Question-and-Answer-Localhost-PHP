<?php
//try to delete the joke
try {
   include "../../includes/connect.php";
   require '../../includes/function.php';
   
   
   session_start();
   $user_id_logging = $_SESSION['user_id'];
   
      
   
   
   
        
        
   //connect to database (compulsory)
   
   $id_question_view = $_POST['question_id'];

   $sql = "SELECT COUNT(*) AS notification_count FROM notification WHERE question_id = :question_id AND user_id = :user_id";
$stm = $connect->prepare($sql);
$stm->bindParam(':question_id', $id_question_view, PDO::PARAM_INT);
$stm->bindParam(':user_id', $user_id_logging, PDO::PARAM_INT);
$stm->execute();
$result = $stm->fetch(PDO::FETCH_ASSOC);

// Check if there is a notification for the user and question
if ($result['notification_count'] > 0) {
    // If there is a notification, activate it
    activateNotification($connect, $id_question_view);
    echo "Notification activated successfully.";
} else {
    echo "No notification found for the user and question.";
}
   
   $sql_view = "SELECT question.question_id, question.user_id, question.vote, user.name, user.user_name, user.avatar, module.module_name, question.title, question.content, question.image, question.date, question.time
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
   

   $comment_view = "SELECT comment.comment_id, comment.vote, user.name, user.user_name, user.avatar, comment.user_id, comment.comment_content, comment.date, comment.time, comment.image
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
   
   include '../../pages_admin/read/view_question.html.php';
   $output = ob_get_clean();
   
}
//catch the error if deleting joke failed
catch (PDOException $exception) {
   //show error here
   echo "Select question failed. Error: " . $exception;
}
include '../../pages_admin/main/layout.html.php';
?>