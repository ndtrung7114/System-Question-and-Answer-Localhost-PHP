<?php

if (isset($_POST['delete_comment'])) {
   try {
      //connect to database (compulsory)
      include "../../includes/connect.php";
      require '../../includes/function.php';
       $comment_id = $_POST['comment_id'];
       $question_id = $_POST['question_id'];
      //prepare the sql statement to delete
      $sql = "DELETE FROM comment WHERE comment_id =  $comment_id";
      $delete = $connect->query($sql);

      update_comment_count($connect, $question_id, '-');
      
      //show successful message
      echo "<h1>Delete question succeed !</h1>";
      header("location: ../read/questions.php");
   }
   //catch the error if deleting joke failed
   catch (PDOException $exception) {
      //show error here
      
      echo "Delete question failed. Error: " . $exception;
   }
} else {
   try {
      //connect to database (compulsory)
      include "../../includes/connect.php";
      require '../../includes/function.php';
       $comment_rep_id = $_POST['comment_rep_id'];
      //prepare the sql statement to delete
      $sql = "DELETE FROM comment_rep WHERE comment_rep_id =  $comment_rep_id";
      $delete = $connect->query($sql);
      
      //show successful message
      echo "<h1>Delete question succeed !</h1>";
      header("location: ../read/questions.php");
   }
   //catch the error if deleting joke failed
   catch (PDOException $exception) {
      //show error here
      
      echo "Delete question failed. Error: " . $exception;
   }
}
//try to delete the joke

?>