<?php 
include "../../includes/connect.php";
require '../../includes/function.php';
$user_id = $_POST['user_id'];
$sql = "SELECT role FROM user WHERE user_id = $user_id";
$result = $connect->query($sql); // Assuming $connect is your database connection object

if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC); // Assuming you're using PDO for database operations
    $role = $row['role'];

    if ($role == 1) {
        echo 'This user already has admin role';
    } else {
        $sql = "UPDATE user SET role = 1 WHERE user_id = $user_id";
        $connect->exec($sql); // Execute the update query
        echo 'User role updated to admin';
    }
} else {
    echo 'Error: Unable to fetch user role from the database';
}
?>
