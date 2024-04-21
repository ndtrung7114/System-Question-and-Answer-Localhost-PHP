<?php
// Include your database connection file
include 'connect.php';
require 'function.php';

$searchCount = 0;
// Check if the search query is set and not empty
if (isset($_POST['search']) && !empty($_POST['search'])) {
    // Sanitize the search query to prevent SQL injection
    $search_question = $_POST['search'];

    // Prepare the SQL query to search for questions with content similar to the search query
    $sql = "SELECT  question.*, module.module_name 
    FROM question 
    INNER JOIN module ON question.module_id = module.module_id
    WHERE content LIKE :search_question ORDER BY question.date DESC, question.time DESC";
    $stmt = $connect->prepare($sql);
    $stmt->bindValue(':search_question', '%' . $search_question . '%', PDO::PARAM_STR);
    $stmt->execute();
    // Count the number of search results
    $searchCount = $stmt->rowCount();

    // Fetch the search results
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ob_start();
    include 'pages/search_question.html.php';
    $output = ob_get_clean();

    // Output the search results
    
} elseif (isset($_POST['filter'])) {
    // Construct the base SQL query
    $sql = "SELECT question.*, module.module_name 
    FROM question 
    INNER JOIN module ON question.module_id = module.module_id";

    // Check if the 'With module' option is selected
    if (isset($_POST['module_id']) && $_POST['module_id'] !== 'none') {
        $module_id = $_POST['module_id'];
        // Add condition to filter by module ID
        $sql .= " WHERE question.module_id = :module_id";

        // Check if the 'Sorted by' option is also selected
        if (isset($_POST['role'])) {
            $sortBy = $_POST['role'];
            // Add sorting condition based on the selected option
            switch ($sortBy) {
                case 'highest vote':
                    $sql .= " ORDER BY question.vote DESC"; // Assuming 'vote_count' is the column storing vote counts
                    break;
                case 'highest view':
                    $sql .= " ORDER BY question.view DESC"; // Assuming 'view' is the column storing view counts
                    break;
                case 'most answer':
                    $sql .= " ORDER BY question.comment DESC"; // Assuming 'answer_count' is the column storing answer counts
                    break;
            }
        }
    } else {
        // 'With module' option is not selected, handle sorting only
        if (isset($_POST['role'])) {
            $sortBy = $_POST['role'];
            // Add sorting condition based on the selected option
            switch ($sortBy) {
                case 'highest vote':
                    $sql .= " ORDER BY question.vote DESC"; // Assuming 'vote_count' is the column storing vote counts
                    break;
                case 'highest view':
                    $sql .= " ORDER BY question.view DESC"; // Assuming 'view' is the column storing view counts
                    break;
                case 'most answer':
                    $sql .= " ORDER BY question.comment DESC"; // Assuming 'answer_count' is the column storing answer counts
                    break;
            }
        }
    }

    // Prepare and execute the SQL query
    $stmt = $connect->prepare($sql);
    
    // Bind module ID parameter if it's set
    if (isset($module_id)) {
        $stmt->bindParam(':module_id', $module_id, PDO::PARAM_INT);
    }

    $stmt->execute();

    // Count the number of search results
    $searchCount = $stmt->rowCount();

    // Fetch the search results
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql_1 = "SELECT *
              FROM module"
              ;

        $modules = $connect->query($sql_1);
    ob_start();
    include 'pages/search_question.html.php';
    $output = ob_get_clean();

    // Output the search results
} else {
    // Form is not submitted, handle accordingly
    echo 'Please submit the form.';
}

include 'pages/layout.html.php'
?>
