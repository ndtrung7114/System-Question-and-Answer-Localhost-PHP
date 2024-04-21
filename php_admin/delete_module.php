<?php
//try to delete the joke
try {
   //connect to database (compulsory)
   include "../connect.php";
    $module_id = $_POST['module_id'];
   //prepare the sql statement to delete
   $sql = "DELETE FROM module WHERE module_id =  $module_id";
   $delete = $connect->query($sql);
   
   //show successful message
   echo "<h1>Delete module succeed !</h1>";
   header("location: module.php");
}
//catch the error if deleting joke failed
catch (PDOException $exception) {
   //show error here
   echo $module_id;
   echo "Delete module failed. Error: " . $exception;
}
?>