<?php

try {
    include '../connect.php';
    require '../function.php';
    session_start();
    $user_id_logging = $_SESSION['user_id'];
    $userDatalogging = get_user_data($user_id_logging, $connect);
    
    // SQL query to select comments saved by the user
    $sql_cmt = "SELECT comment.comment_content, comment.question_id, comment.user_id FROM save_comment  
    INNER JOIN comment ON comment.comment_id = save_comment.comment_id 
    WHERE save_comment.user_id = :user_id";
    $stmt = $connect->prepare($sql_cmt);
    $stmt->bindParam(':user_id', $user_id_logging, PDO::PARAM_INT);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql_ques = "SELECT question.*, save_question.question_id from question  INNER JOIN save_question ON question.question_id = save_question.question_id WHERE save_question.user_id = :user_id";
    $stmt = $connect->prepare($sql_ques);
    $stmt->bindParam(':user_id', $user_id_logging, PDO::PARAM_INT);
    $stmt->execute();
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ob_start();
    include '../pages_admin/save.html.php';
    $output = ob_get_clean();
    
} catch (PDOException $exception) {
    echo "Connect to database failed";
    $output = 'Database error: ' . $exception->getMessage();
}

include '../pages_admin/layout.html.php';
?>
