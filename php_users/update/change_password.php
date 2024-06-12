<?php
// UPDATE feature: edit existing data from the database
if (isset($_POST['change'])) {
    try {
        include "../../includes/connect.php";
        require '../../includes/function.php';
        $old_password = $_POST['old_password'];
        $type_old_password = $_POST['type_old_password'];
        $check_pass = password_verify( $type_old_password, $old_password);
       
        
        if ($check_pass) {
            $password = $_POST['new_password'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "UPDATE user
                    SET 
                    password = :password
                    WHERE user_id = :user_id";
            $stm = $connect->prepare($sql);
            
            
            $stm->bindValue(":user_id", $_POST['user_id']);
        
            $stm->bindValue(":password", $hashed_password);

            $stm->execute();
            header("location: ../read/user.php");
            
    } else {
        
        ob_start();
        include  '../../pages_user/update/notice_change_pass.html.php';
        $output = ob_get_clean();
    }

        } catch (PDOException $exception) {
            echo "Connect to DB failed" . $exception;
        }
        
} else {
    try {
        include "../../includes/connect.php";
        require '../../includes/function.php';
       
        
        $user_id = $_POST['user_id'];
        $sql = "SELECT * FROM user WHERE user_id = :user_id";
        $stm = $connect->prepare($sql);
        $stm->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stm->execute();

        $user_infor = $stm->fetch(PDO::FETCH_ASSOC);
        
        ob_start();
        include  '../../pages_user/update/change_password.html.php';
        $output = ob_get_clean();

        
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
}
include '../../pages_user/main/layout.html.php';
?>