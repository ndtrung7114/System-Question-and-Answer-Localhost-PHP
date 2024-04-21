<?php
include 'connect.php' ;

if(isset($_POST['minus'])) {
    $comment_id = $_POST['comment_id'];
    $user_id = $_POST['user_id_logging'];

    // Check if the user has already voted for the question
    $check_query = "SELECT * FROM vote_comment WHERE user_id = ? AND comment_id = ?";
    $check_stmt = $connect->prepare($check_query);
    $check_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $check_stmt->bindParam(2, $comment_id, PDO::PARAM_INT);
    $check_stmt->execute();
    $existing_vote = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_vote) {
        // User hasn't voted for the question, insert a new record into the Votes table
        $insert_query = "DELETE FROM vote_comment WHERE user_id = ? AND comment_id = ?";
        $insert_stmt = $connect->prepare($insert_query);
        $insert_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $insert_stmt->bindParam(2, $comment_id, PDO::PARAM_INT);
        $insert_stmt->execute();
        echo "Delete recorded successfully.";
        header("location: questions.php");
    } else {
        echo "You haven't voted for this comment.";
        header("location: questions.php");
    }
} elseif (isset($_POST['minus_comment_rep'])) {
    $comment_rep_id = $_POST['comment_rep_id'];
    $user_id = $_POST['user_id_logging'];

    // Check if the user has already voted for the question
    $check_query = "SELECT * FROM vote_comment_rep WHERE user_id = ? AND comment_rep_id = ?";
    $check_stmt = $connect->prepare($check_query);
    $check_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $check_stmt->bindParam(2, $comment_rep_id, PDO::PARAM_INT);
    $check_stmt->execute();
    $existing_vote = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_vote) {
        // User hasn't voted for the question, insert a new record into the Votes table
        $insert_query = "DELETE FROM vote_comment_rep WHERE user_id = ? AND comment_rep_id = ?";
        $insert_stmt = $connect->prepare($insert_query);
        $insert_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $insert_stmt->bindParam(2, $comment_rep_id, PDO::PARAM_INT);
        $insert_stmt->execute();
        echo "Delete recorded successfully.";
        header("location: questions.php");
    } else {
        echo "You haven't voted for this comment.";
        header("location: questions.php");
    }
}
?>