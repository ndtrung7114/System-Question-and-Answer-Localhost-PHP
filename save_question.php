<?php
include 'connect.php' ;

if(isset($_POST['user_id'])) {
    $question_id = $_POST['question_id'];
    $user_id = $_POST['user_id'];

    // Check if the user has already save for the question
    $check_query = "SELECT * FROM save_question WHERE user_id = ? AND question_id = ?";
    $check_stmt = $connect->prepare($check_query);
    $check_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $check_stmt->bindParam(2, $question_id, PDO::PARAM_INT);
    $check_stmt->execute();
    $existing_vote = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$existing_vote) {
        // User hasn't voted for the question, insert a new record into the Votes table
        $insert_query = "INSERT INTO save_question (user_id, question_id) values ('$user_id', '$question_id')";
        $insert_stmt = $connect->prepare($insert_query);
        $insert_stmt->execute();

        header("location: questions.php");
    } else {
        echo "You haven't save for this question.";
        header("location: questions.php");
    }
} else {
    echo "Invalid request.";
}
?>