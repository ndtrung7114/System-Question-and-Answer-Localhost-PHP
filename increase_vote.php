<?php
include 'connect.php' ;
require 'function.php';

if(isset($_POST['plus'])) {
    $question_id = $_POST['question_id'];
    $user_id = $_POST['user_id_logging'];
    update_vote_count($connect, $question_id, '+');
    // Check if the user has already voted for the question
    $check_query = "SELECT * FROM vote WHERE user_id = ? AND question_id = ?";
    $check_stmt = $connect->prepare($check_query);
    $check_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $check_stmt->bindParam(2, $question_id, PDO::PARAM_INT);
    $check_stmt->execute();
    $existing_vote = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$existing_vote) {
        // User hasn't voted for the question, insert a new record into the Votes table
        $insert_query = "INSERT INTO vote (user_id, question_id) VALUES (?, ?)";
        $insert_stmt = $connect->prepare($insert_query);
        $insert_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $insert_stmt->bindParam(2, $question_id, PDO::PARAM_INT);
        $insert_stmt->execute();
        echo "Vote recorded successfully.";
        header("location: questions.php");
    } else {
        return $existing_vote;
        
    }
} else {
    echo "Invalid request.";
}
?>
