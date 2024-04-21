<?php
// UPDATE feature: edit existing data from the database
if (isset($_POST['add_module'])) {
    try {
        include "../connect.php";
        require "../function.php";
        $module_name = $_POST['module_name'];
        $sql = "INSERT INTO module (module_name) VALUES ('$module_name')";
        $stm = $connect->query($sql);
        header("location: module.php");
    } catch (PDOException $exception) {
        echo "Connect to DB failed" . $exception;
    }
} else {
    try {
        include "../connect.php";
        require "../function.php";
        $title = 'Add Module';
        ob_start();
        include  '../pages_admin/add_module.html.php';
        $output = ob_get_clean();

        
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
}
include '../pages_admin/layout.html.php';
?>
