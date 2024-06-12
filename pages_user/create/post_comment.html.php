<?php 
$question_id_comment = $_POST['question_id'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Comment</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Post Your Answer</h2>
        <form id="commentForm" action="../../php_users/create/post_comment.php" method="post">
            <!-- Comment Content -->
            <div class="form-group">
                <label for="comment">Your Comment</label>
                <input type="text" class="form-control" id="comment" rows="3" height="5" placeholder="Type your comment here" name="comment_content">
            </div>
            <!-- Hidden input field to store the date -->
            <input type="hidden" id="date" name="date">
            <input type="hidden" name="question_id" value=<?=$question_id_comment?>>
            <!-- Submit Button -->
            <input type="submit" class="btn btn-primary" name="post" value="Post Your Answer">
        </form>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript to set current date -->
    <script>
        // Function to get current date in the required format (YYYY-MM-DD)
        function getCurrentDate() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0'); // Add leading zero if needed
            const day = String(now.getDate()).padStart(2, '0'); // Add leading zero if needed
            const currentDate = `${year}-${month}-${day}`;
            return currentDate;
        }

        // Set current date in the hidden input field when the form is submitted
        document.getElementById('commentForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Set the value of the hidden input field to the current date
            document.getElementById('date').value = getCurrentDate();

            // Submit the form
            this.submit();
        });
    </script>
</body>
</html>
