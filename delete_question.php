<?php
//try to delete the joke
try {
   //connect to database (compulsory)
   include "connect.php";
    $question_id = $_POST['question_id'];
   //prepare the sql statement to delete
   $sql = "DELETE FROM question WHERE question_id =  $question_id";
   $delete = $connect->query($sql);
   
   //show successful message
   echo "<h1>Delete question succeed !</h1>";
   header("location: questions.php");
}
//catch the error if deleting joke failed
catch (PDOException $exception) {
   //show error here
   echo $question_id;
   echo "Delete question failed. Error: " . $exception;
}
?>