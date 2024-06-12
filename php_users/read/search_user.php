<?php
// Include your database connection file
include "../../includes/connect.php";
require '../../includes/function.php';

$searchCount = 0;
// Check if the search query is set and not empty
if (isset($_POST['search_user']) && !empty($_POST['search_user'])) {
    // Sanitize the search query to prevent SQL injection
    $search_user = $_POST['search_user'];

    // Prepare the SQL query to search for questions with content similar to the search query
    $sql = "SELECT * FROM user WHERE user_name LIKE :search_user";
    $stmt = $connect->prepare($sql);
    $stmt->bindValue(':search_user', '%' . $search_user . '%', PDO::PARAM_STR);
    $stmt->execute();
    // Count the number of search results
    $searchCountuser = $stmt->rowCount();

    // Fetch the search results
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ob_start();
    include '../../pages_user/read/user.html.php';
    include '../../pages_user/read/search_user.html.php';
    $output = ob_get_clean();

    // Output the search results
    
} elseif (isset($_POST['reputation'])) {
    // Prepare the SQL query to search for questions with content similar to the search query
    $sql = "SELECT * FROM user  ORDER BY reputation DESC";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    // Count the number of search results
    $searchCountuser = '';

    // Fetch the search results
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ob_start();
    include '../../pages_user/read/user.html.php';
    include '../../pages_user/read/search_user.html.php';
    $output = ob_get_clean();
} elseif (isset($_POST['new_user'])) {
    // Prepare the SQL query to search for questions with content similar to the search query
    $sql = "SELECT * FROM user  ORDER BY create_at DESC";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    // Count the number of search results
    $searchCountuser = '';

    // Fetch the search results
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ob_start();
    include '../../pages_user/read/user.html.php';
    include '../../pages_user/read/search_user.html.php';
    $output = ob_get_clean();
} elseif (isset($_POST['name_user'])) {
    // Prepare the SQL query to search for questions with content similar to the search query
    $sql = "SELECT * FROM user  ORDER BY user_name ASC";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    // Count the number of search results
    $searchCountuser = '';

    // Fetch the search results
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ob_start();
    include '../../pages_user/read/user.html.php';
    include '../../pages_user/read/search_user.html.php';
    $output = ob_get_clean();
}
include '../../pages_user/main/layout.html.php'

?>
