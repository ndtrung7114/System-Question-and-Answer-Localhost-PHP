<?php 
include "../../includes/connect.php";
require '../../includes/function.php';
$sql = "SELECT * FROM user";
$infor = $connect->query($sql);
if (isset($_POST['sign_in'])) {
    // Retrieve user input
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Query the database to retrieve the hashed password associated with the email
    $stmt = $connect->prepare("SELECT user_id, password, role FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // If no matching user is found
    if (!$row) {
        echo "Invalid email or password";
        exit(); // Exit after displaying the error message
    }

    // Verify the password using password_verify
    if (password_verify($password, $row['password'])) {
        // Password is correct, proceed with role validation
        if ($row["role"] == 0 && $role == 'user') {
            // User role matches, set session and redirect to appropriate page
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            header("location: ../main/index.php");
            exit(); // Exit after redirecting
        } elseif ($row["role"] == 1 && $role == 'admin') {
            // Admin role matches, set session and redirect to appropriate page
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            header("location: ../../php_admin/main/index.php");
            exit(); // Exit after redirecting
        } else {
            // Role mismatch
            echo "This account is not for $role role.";
            exit(); // Exit after displaying the error message
        }
    } else {
        // Incorrect password
        echo "Invalid email or password";
        exit(); // Exit after displaying the error message
    }
}

if (isset($_POST['sign_up'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_name = $_POST['user_name'];
    $date = date('Y-m-d');
    $gender = $_POST['gender'];


    // Query the database to check if the email already exists
    $stmt = $connect->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $count = $stmt->fetchColumn();

    // If the email already exists, display an error message
    if ($count > 0) {
        
        echo "<a href='../../pages_user/register/sign_up.html.php' ;>This email is already registered. Please choose a different one. Try again</a>";
        
        
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if ($gender == 'men') {
            $avatar = 'men.jpg';
        } else {
            $avatar = 'girl.jpg';
        }
        // Insert the user's data into the database if the email doesn't exist
        $sql3 = "INSERT INTO user ( email, password, user_name, create_at, avatar) VALUES ( '$email', '$hashed_password', '$user_name', '$date', '$avatar')";
        $insert = $connect->query($sql3);
        header("location: ../../pages_user/register/register.html.php");
    }
    
}




?> 
