<?php

if (isset($_POST['delete_comment'])) {
   try {
      //connect to database (compulsory)
      include "../connect.php";
       $comment_id = $_POST['comment_id'];
      //prepare the sql statement to delete
      $sql = "DELETE FROM comment WHERE comment_id =  $comment_id";
      $delete = $connect->query($sql);
      
      //show successful message
      echo "<h1>Delete question succeed !</h1>";
      header("location: questions.php");
   }
   //catch the error if deleting joke failed
   catch (PDOException $exception) {
      //show error here
      
      echo "Delete question failed. Error: " . $exception;
   }
} else {
   try {
      //connect to database (compulsory)
      include "../connect.php";
       $comment_rep_id = $_POST['comment_rep_id'];
      //prepare the sql statement to delete
      $sql = "DELETE FROM comment_rep WHERE comment_rep_id =  $comment_rep_id";
      $delete = $connect->query($sql);
      
      //show successful message
      echo "<h1>Delete question succeed !</h1>";
      header("location: questions.php");
   }
   //catch the error if deleting joke failed
   catch (PDOException $exception) {
      //show error here
      
      echo "Delete question failed. Error: " . $exception;
   }
}
//try to delete the joke

?>