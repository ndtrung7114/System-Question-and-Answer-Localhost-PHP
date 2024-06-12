<?php
//try to delete the joke
try {
   //connect to database (compulsory)
   include "../../includes/connect.php";
   require '../../includes/function.php';
    $user_id = $_POST['user_id'];
   //prepare the sql statement to delete
   $sql = "DELETE FROM user WHERE user_id =  $user_id";
   $delete = $connect->query($sql);
   
   //show successful message
   echo "<h1>Delete user succeed !</h1>";
   header("location: ../pages/register.html.php");
}
//catch the error if deleting joke failed
catch (PDOException $exception) {
   //show error here
   echo $user_id;
   echo "Delete user failed. Error: " . $exception;
}
?>