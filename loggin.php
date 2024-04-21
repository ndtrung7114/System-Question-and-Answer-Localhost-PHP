<?php 
include "connect.php";
$sql = "SELECT * FROM user";
$infor = $connect->query($sql);
if (isset($_POST['sign_in'])) {
    // Retrieve user input
    $email = $_POST['email'] ;
    $password = $_POST['password'] ;
    $role = $_POST['role'] ;
    

    foreach ($infor as $row) {
        if ($row["password"] == $password && $row["email"] == $email) {
            if ($row["role"] == 0) {
                if ($role == 'user') {
                    session_start();
                    $_SESSION['user_id'] = $row['user_id'];
                    header("location: index.php");
                    exit(); // Exit after redirecting
                } else {
                    echo 'This account is not for admin role.';
                    exit(); // Exit after displaying the error message
                }
            } elseif ($row["role"] == 1) {
                if ($role == 'admin') {
                    session_start();
                    $_SESSION['user_id'] = $row['user_id'];
                    header("location: php_admin/index.php");
                    exit(); // Exit after redirecting
                } else {
                    echo 'This account is not for user role.';
                    exit(); // Exit after displaying the error message
                }
            }
        }
    }
    // If no matching user is found
    echo "Invalid email, password";
}

if (isset($_POST['sign_up'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_name = $_POST['user_name'];
    $date = date('Y-m-d');


    // Query the database to check if the email already exists
    $stmt = $connect->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $count = $stmt->fetchColumn();

    // If the email already exists, display an error message
    if ($count > 0) {
        
        echo "<a href='pages/sign_up.html.php' ;>This email is already registered. Please choose a different one. Try again</a>";
        
        
    } else {
        // Insert the user's data into the database if the email doesn't exist
        $sql3 = "INSERT INTO user ( email, password, user_name, create_at) VALUES ( '$email', '$password', '$user_name', '$date')";
        $insert = $connect->query($sql3);
        header("location: pages/register.html.php");
    }
    
}




?> 
