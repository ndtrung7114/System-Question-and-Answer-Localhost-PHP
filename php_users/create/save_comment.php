<?php
include "../../includes/connect.php";
require '../../includes/function.php';

if(isset($_POST['save_comment'])) {
    $comment_id = $_POST['comment_id'];
    $user_id = $_POST['user_id'];

    // Check if the user has already save for the comment
    $check_query = "SELECT * FROM save_comment WHERE user_id = ? AND comment_id = ?";
    $check_stmt = $connect->prepare($check_query);
    $check_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $check_stmt->bindParam(2, $comment_id, PDO::PARAM_INT);
    $check_stmt->execute();
    $existing_vote = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$existing_vote) {
        // User hasn't voted for the question, insert a new record into the Votes table
        $insert_query = "INSERT INTO save_comment (user_id, comment_id) values ('$user_id', '$comment_id')";
        $insert_stmt = $connect->prepare($insert_query);
        $insert_stmt->execute();

        header("location: ../read/questions.php");
    } else {
        echo "You haven't save for this comment.";

    }
} else {
    echo "Invalid request.";
}
?>