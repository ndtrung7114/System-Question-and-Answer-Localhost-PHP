<?php
include "../../includes/connect.php";
require '../../includes/function.php';
 
  if (isset($_POST['query'])) {
    $inpText = $_POST['query'];
    $sql = 'SELECT module_name FROM module WHERE module_name LIKE :name';
    $stmt = $connect->prepare($sql);
    $stmt->execute(['name' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll();
 
    if ($result) {
      foreach ($result as $row) {
        echo '<a href="#" class="list-group-item list-group-item-action border-1">' . $row['module_name'] . '</a>';
      }
    } else {
      echo '<p class="list-group-item border-1">No Record</p>';
    }
  }
?>