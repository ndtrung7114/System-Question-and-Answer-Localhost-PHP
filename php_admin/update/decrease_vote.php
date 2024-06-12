<?php

include "../../includes/connect.php";
require '../../includes/function.php';

if(isset($_POST['minus']))  {
    $question_id = $_POST['question_id'];
    $user_id = $_POST['user_id_logging'];
    $user_id_question = $_POST['question_id_user'];
    update_vote_count($connect, $question_id, '-');

    // Check if the user has voted for the question
    $check_query = "SELECT * FROM vote WHERE user_id = ? AND question_id = ?";
    $check_stmt = $connect->prepare($check_query);
    $check_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $check_stmt->bindParam(2, $question_id, PDO::PARAM_INT);
    $check_stmt->execute();
    $existing_vote = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_vote) {
        // User has voted for the question, delete the corresponding record from the Votes table
        $delete_query = "DELETE FROM vote WHERE user_id = ? AND question_id = ?";
        $delete_stmt = $connect->prepare($delete_query);
        $delete_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $delete_stmt->bindParam(2, $question_id, PDO::PARAM_INT);
        $delete_stmt->execute();
        
        $sql_update = "UPDATE user SET reputation = reputation - 1 WHERE user_id = ?";
        $stmt_update = $connect->prepare($sql_update);
        $stmt_update->bindParam(1, $user_id_question, PDO::PARAM_INT);
        $stmt_update->execute();
        
        header("location: ../read/questions.php");
        
    } else {
        echo "You haven't voted for this question.";
        
    }
} else {
    echo "Invalid request.";
}
?>
