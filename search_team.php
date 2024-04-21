<?php
// Include your database connection file
include 'connect.php';
require 'function.php';

$searchCount = 0;
// Check if the search query is set and not empty
if (isset($_POST['search_team']) && !empty($_POST['search_team'])) {
    // Sanitize the search query to prevent SQL injection
    $search_team = $_POST['search_team'];

    // Prepare the SQL query to search for questions with content similar to the search query
    $sql = "SELECT * FROM team WHERE team_name LIKE :search_team";
    $stmt = $connect->prepare($sql);
    $stmt->bindValue(':search_team', '%' . $search_team . '%', PDO::PARAM_STR);
    $stmt->execute();
    // Count the number of search results
    $searchCountteam = $stmt->rowCount();

    // Fetch the search results
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ob_start();
    // include 'pages/teams.html.php';
    include 'pages/search_team.html.php';
    $output = ob_get_clean();

    // Output the search results
    
} 
include 'pages/layout.html.php'

?>
