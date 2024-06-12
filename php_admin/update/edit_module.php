<?php
// UPDATE feature: edit existing data from the database
if (isset($_POST['edit'])) {
    try {
        include "../../includes/connect.php";
        require '../../includes/function.php';
        
        $sql = "UPDATE module
                SET module_name = :module_name
                WHERE module_id = :module_id";
        $stm = $connect->prepare($sql);
        $stm->bindValue(":module_name", $_POST['module_name']);
        
        $stm->bindValue(":module_id", $_POST['module_id']);

        $stm->execute();
        header("location: ../read/module.php");
    } catch (PDOException $exception) {
        echo "Connect to DB failed" . $exception;
    }
} else {
    try {
        include "../../includes/connect.php";
        require '../../includes/function.php';
        $module_id = $_POST['module_id']; 
        $sql = "SELECT * FROM module WHERE module_id = :module_id";
        $stm = $connect->prepare($sql);
        $stm->bindValue(":module_id", $module_id);
        $stm->execute();
        
        $module = $stm->fetch();
        $title = 'Edit module';
        ob_start();
        include  '../../pages_admin/update/edit_module.html.php';
        $output = ob_get_clean();

        
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
}
include '../../pages_admin/main/layout.html.php';
?>
