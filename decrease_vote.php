<?php

include 'connect.php';
require 'function.php';

if(isset($_POST['minus']))  {
    $question_id = $_POST['question_id'];
    $user_id = $_POST['user_id_logging'];
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
        echo "Vote removed successfully.";
        header("location: questions.php");
    } else {
        echo "You haven't voted for this question.";
        header("location: questions.php");
    }
} else {
    echo "Invalid request.";
}
?>
