<?php
// Include your database connection file
include '../connect.php';
require '../function.php';

$searchCount = 0;
// Check if the search query is set and not empty
if (isset($_POST['search_module']) && !empty($_POST['search_module'])) {
    // Sanitize the search query to prevent SQL injection
    $search_module = $_POST['search_module'];

    // Prepare the SQL query to search for questions with content similar to the search query
    $sql = "SELECT * FROM module WHERE module_name LIKE :search_module";
    $stmt = $connect->prepare($sql);
    $stmt->bindValue(':search_module', '%' . $search_module . '%', PDO::PARAM_STR);
    $stmt->execute();
    // Count the number of search results
    $searchCountmodule = $stmt->rowCount();

    // Fetch the search results
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ob_start();
    
    include '../pages_admin/search_module.html.php';
    $output = ob_get_clean();

    // Output the search results
    
} elseif (isset($_POST['search_from_question'])) {
    $module_id = $_POST['module_id'];

    // Prepare the SQL query to search for questions with content similar to the search query
    $sql = "SELECT * FROM module WHERE module_id = :module_id";
    $stmt = $connect->prepare($sql);
    $stmt->bindValue(':module_id', $module_id);
    $stmt->execute();
    // Count the number of search results
    $searchCountmodule = $stmt->rowCount();

    // Fetch the search results
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ob_start();
    
    include '../pages_admin/search_module.html.php';
    $output = ob_get_clean();
} else{
    echo 'invalid action';
}
include '../pages_admin/layout.html.php'

?>