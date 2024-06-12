<?php
include "../../includes/connect.php";
require '../../includes/function.php';

if(isset($_POST['minus'])) {
    $comment_id = $_POST['comment_id'];
    $user_id = $_POST['user_id_logging'];
    $user_id_comment = $_POST['user_id_comment'];
    update_vote_comment_count($connect, $comment_id, '-');
    // Check if the user has already voted for the question
    $check_query = "SELECT * FROM vote_comment WHERE user_id = ? AND comment_id = ?";
    $check_stmt = $connect->prepare($check_query);
    $check_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $check_stmt->bindParam(2, $comment_id, PDO::PARAM_INT);
    $check_stmt->execute();
    $existing_vote = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_vote) {
        
        $insert_query = "DELETE FROM vote_comment WHERE user_id = ? AND comment_id = ?";
        $insert_stmt = $connect->prepare($insert_query);
        $insert_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $insert_stmt->bindParam(2, $comment_id, PDO::PARAM_INT);
        $insert_stmt->execute();

        $sql_update = "UPDATE user SET reputation = reputation - 1 WHERE user_id = ?";
        $stmt_update = $connect->prepare($sql_update);
        $stmt_update->bindParam(1, $user_id_comment, PDO::PARAM_INT);
        $stmt_update->execute();

        echo "Delete recorded successfully.";
        header("location: ../read/questions.php");
    } else {
        echo "You haven't voted for this comment.";
        header("location: ../read/questions.php");
    }
} else {
    echo 'invalid';
}
?>