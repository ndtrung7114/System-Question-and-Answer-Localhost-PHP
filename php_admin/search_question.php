<?php
// Include your database connection file
include '../connect.php';
require '../function.php';

$searchCount = 0;
// Check if the search query is set and not empty
if (isset($_POST['search']) && !empty($_POST['search'])) {
    // Sanitize the search query to prevent SQL injection
    $search_question = $_POST['search'];

    // Prepare the SQL query to search for questions with content similar to the search query
    $sql = "SELECT * FROM question WHERE content LIKE :search_question ORDER BY date DESC, time DESC";
    $stmt = $connect->prepare($sql);
    $stmt->bindValue(':search_question', '%' . $search_question . '%', PDO::PARAM_STR);
    $stmt->execute();
    // Count the number of search results
    $searchCount = $stmt->rowCount();

    // Fetch the search results
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ob_start();
    include '../pages_admin/search_question.html.php';
    $output = ob_get_clean();

    // Output the search results
    
} else {
    // Search query is not set or empty
    echo 'Please enter a search query.';
}
include '../pages_admin/layout.html.php'
?>
