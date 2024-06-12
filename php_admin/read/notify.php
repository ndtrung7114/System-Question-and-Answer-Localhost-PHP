<?php

try {
    include "../../includes/connect.php";
    require '../../includes/function.php';
    session_start();
    $user_id_logging = $_SESSION['user_id'];
    $userDatalogging = get_user_data($user_id_logging, $connect);
    
    // SQL query to select comments saved by the user
    $sql = "SELECT * FROM notification 
    INNER JOIN question ON notification.question_id = question.question_id 
    WHERE notification.user_id = :user_id and notification.activate = 1
    ORDER BY notification.date DESC, notification.time DESC";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':user_id', $user_id_logging, PDO::PARAM_INT);
    $stmt->execute();
    $notices = $stmt->fetchAll(PDO::FETCH_ASSOC);

    

    ob_start();
    include '../../pages_admin/read/notify.html.php';
    $output = ob_get_clean();
    
} catch (PDOException $exception) {
    echo "Connect to database failed";
    $output = 'Database error: ' . $exception->getMessage();
}

include '../../pages_admin/main/layout.html.php';
?>
