<?php
// Include your database connection file



if (isset($_POST['add_team'])) {
        try {
            include "connect.php";
            require "function.php";
            
            $team_name = $_POST['team_name'];
            $leader = $_POST['leader'];
            
            
    
    
    $sql = "INSERT INTO team (team_name, leader) VALUES (:team_name, :leader)";
        $stm = $connect->prepare($sql);
        $stm->bindValue(":team_name", $team_name);
        $stm->bindValue(":leader", $leader);
        
    
        $stm->execute();
        header("location: team.php");
        
    
            
        } catch (PDOException $exception) {
            echo "Connect to DB failed" . $exception;
        }
    } else {
        try {
            include "connect.php";
            require "function.php";
            
            ob_start();
            include __DIR__ . '/pages/create_team.html.php';
            $output = ob_get_clean();
    
            
        } catch (PDOException $e) {
            $title = 'An error has occurred';
            $output = 'Database error: ' . $e->getMessage();
        }
    }
include 'pages/layout.html.php'

?>
