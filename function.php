<?php 
include 'connect.php' ;
function get_user_data($user_id, $connect) {
    // SQL query to check user credentials
    $sql = "SELECT * FROM user WHERE user_id = $user_id";
    $statement = $connect->query($sql);
    
    // Fetch one row
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    // Output the row
    return $row;
}

function count_total_comment($connect, $table, $question_id) {
    $sql = "SELECT COUNT(*) FROM $table WHERE question_id = $question_id";
    $query = $connect->prepare($sql);
    $query->execute();
    $result = $query->fetch();
    return $result[0];
 }

 function update_view_count($connect, $question_id) {
    try {
        // Prepare and execute the SQL query to update the view count
        $sql = "UPDATE question SET view = view + 1 WHERE question_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $question_id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the updated view count from the database
        $sql_get_views = "SELECT view FROM question WHERE question_id = ?";
        $stmt_get_views = $connect->prepare($sql_get_views);
        $stmt_get_views->bindParam(1, $question_id, PDO::PARAM_INT);
        $stmt_get_views->execute();
        $result = $stmt_get_views->fetch(PDO::FETCH_ASSOC);

        return $result['view']; // Return the updated view count
    } catch (PDOException $exception) {
        // Handle any errors
        echo "Error updating view count: " . $exception->getMessage();
        return false; // Return false if update fails
    }
}


function update_vote_count($connect, $question_id, $type) {
  try {
      // Prepare and execute the SQL query to update the vote count based on the type
      if ($type === '+') {
          $sql = "UPDATE question SET vote = vote + 1 WHERE question_id = ?";
      } elseif ($type === '-') {
          $sql = "UPDATE question SET vote = vote - 1 WHERE question_id = ?";
      } else {
          // Invalid type
          echo "Invalid type: " . $type;
          return false;
      }

      $stmt = $connect->prepare($sql);
      $stmt->bindParam(1, $question_id, PDO::PARAM_INT);
      $stmt->execute();

      // Return true if update is successful
      return true;
  } catch (PDOException $exception) {
      // Handle any errors
      echo "Error updating vote count: " . $exception->getMessage();
      return false; // Return false if update fails
  }
}

function update_comment_count($connect, $question_id, $type) {
  try {
      // Prepare and execute the SQL query to update the vote count based on the type
      if ($type === '+') {
          $sql = "UPDATE question SET comment = comment + 1 WHERE question_id = ?";
      } elseif ($type === '-') {
          $sql = "UPDATE question SET comment = comment - 1 WHERE question_id = ?";
      } else {
          // Invalid type
          echo "Invalid type: " . $type;
          return false;
      }

      $stmt = $connect->prepare($sql);
      $stmt->bindParam(1, $question_id, PDO::PARAM_INT);
      $stmt->execute();

      // Return true if update is successful
      return true;
  } catch (PDOException $exception) {
      // Handle any errors
      echo "Error updating comment count: " . $exception->getMessage();
      return false; // Return false if update fails
  }
}

function count_votes_for_question($connect, $question_id) {
    try {
        // Prepare the SQL query to count votes for the given question ID
        $sql = "SELECT COUNT(*) FROM vote WHERE question_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $question_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Fetch the result
        $result = $stmt->fetchColumn();

        // Return the count of votes
        return $result;
    } catch (PDOException $exception) {
        // Handle any errors
        echo "Error counting votes: " . $exception->getMessage();
        return false; // Return false if there's an error
    }
}

function getCommentReplies($connect, $comment_id) {
    try {
        // SQL query to fetch comment replies for a given comment_id
        $sql = "SELECT comment_rep.*, user.name, user.user_name
        FROM comment_rep
        INNER JOIN user ON comment_rep.user_id = user.user_id
        WHERE comment_id = :comment_id
        ORDER BY comment_rep.date DESC, comment_rep.time DESC";
        
        // Prepare the SQL statement
        $stmt = $connect->prepare($sql);
        
        // Bind the parameter
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        
        // Execute the query
        $stmt->execute();
        
        // Fetch all rows
        $comment_replies = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $comment_replies;
    } catch (PDOException $e) {
        // Handle database errors
        return [];
    }
}

function setupAutocompleteScript($searchInputId, $autocompleteScript) {
    $script = <<<SCRIPT
    <script>
    $(document).ready(function () {
      // Send Search Text to the server
      $("#{$searchInputId}").keyup(function () {
        let searchText = $(this).val();
        if (searchText != "") {
          $.ajax({
            url: "{$autocompleteScript}",
            method: "post",
            data: {
              query: searchText,
            },
            success: function (response) {
              $("#show-list").html(response);
            },
          });
        } else {
          $("#show-list").html("");
        }
      });
      // Set searched text in input field on click of search button
      $(document).on("click", "a", function () {
        $("#{$searchInputId}").val($(this).text());
        $("#show-list").html("");
      });
    });
    </script>
SCRIPT;

    return $script;
}

function elapsedTimeSinceCreation($creationDate) {
  // Create DateTime objects for the account creation date and the current date
  $creationDateTime = new DateTime($creationDate);
  $currentDateTime = new DateTime();

  // Calculate the difference between the two dates
  $interval = $currentDateTime->diff($creationDateTime);

  // Calculate years, months, days, and hours
  $years = $interval->y;
  $months = $interval->m;
  $days = $interval->d;
  $hours = $interval->h + ($interval->days * 24);

  // Construct the string
  $result = '';
  if ($years > 0) {
      $result .= "{$years} years, ";
  }
  if ($months > 0) {
      $result .= "{$months} months, ";
  }
  if ($days > 0) {
      $result .= "{$days} days, ";
  }
  if ($days <= 0) {
    $result .= "0 days ";
}
  
  // Remove the trailing comma and space if present
  $result = rtrim($result, ', ');

  // Add 'and' if needed
  if (substr_count($result, ',') > 1) {
      $lastCommaPos = strrpos($result, ',');
      $result = substr_replace($result, ', and', $lastCommaPos, 1);
  }

  return $result;
}


?>

