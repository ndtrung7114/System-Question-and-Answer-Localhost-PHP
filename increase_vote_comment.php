<?php
include 'connect.php' ;

if(isset($_POST['plus'])) {
    $comment_id = $_POST['comment_id'];
    $user_id = $_POST['user_id_logging'];
    $user_id_comment = $_POST['user_id_comment'];

    // Check if the user has already voted for the question
    $check_query = "SELECT * FROM vote_comment WHERE user_id = ? AND comment_id = ?";
    $check_stmt = $connect->prepare($check_query);
    $check_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $check_stmt->bindParam(2, $comment_id, PDO::PARAM_INT);
    $check_stmt->execute();
    $existing_vote = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$existing_vote) {
        // User hasn't voted for the comment, insert a new record into the Votes table
        $insert_query = "INSERT INTO vote_comment (user_id, comment_id) VALUES (?, ?)";
        $insert_stmt = $connect->prepare($insert_query);
        $insert_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $insert_stmt->bindParam(2, $comment_id, PDO::PARAM_INT);
        $insert_stmt->execute();

        $sql_update = "UPDATE user SET reputation = reputation + 1 WHERE user_id = ?";
        $stmt_update = $connect->prepare($sql_update);
        $stmt_update->bindParam(1, $user_id_comment, PDO::PARAM_INT);
        $stmt_update->execute();
        
        echo "Vote recorded successfully.";
        header("location: questions.php");
    } else {
        echo "You have already voted for this question.";
        header("location: questions.php");
    }
} elseif (isset($_POST['plus_comment_rep'])) {
    $comment_rep_id = $_POST['comment_rep_id'];
    $user_id = $_POST['user_id_logging'];
    $user_id_comment_rep = $_POST['user_id_comment_rep'];

    // Check if the user has already voted for the question
    $check_query = "SELECT * FROM vote_comment_rep WHERE user_id = ? AND comment_rep_id = ?";
    $check_stmt = $connect->prepare($check_query);
    $check_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $check_stmt->bindParam(2, $comment_rep_id, PDO::PARAM_INT);
    $check_stmt->execute();
    $existing_vote = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$existing_vote) {
        // User hasn't voted for the comment, insert a new record into the Votes table
        $insert_query = "INSERT INTO vote_comment_rep (user_id, comment_rep_id) VALUES (?, ?)";
        $insert_stmt = $connect->prepare($insert_query);
        $insert_stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $insert_stmt->bindParam(2, $comment_rep_id, PDO::PARAM_INT);
        $insert_stmt->execute();

        $sql_update = "UPDATE user SET reputation = reputation + 1 WHERE user_id = ?";
        $stmt_update = $connect->prepare($sql_update);
        $stmt_update->bindParam(1, $user_id_comment_rep, PDO::PARAM_INT);
        $stmt_update->execute();
        
        echo "Vote recorded successfully.";
        header("location: questions.php");
    } else {
        echo "You have already voted for this question.";
        header("location: questions.php");
    }
} else {
    echo'invalid';
}
?>