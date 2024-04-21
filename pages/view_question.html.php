<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question List</title>
    <link rel="stylesheet" href="view_question.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS for styling the comments */
        .comment {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        .comment .author {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .comment .content {
            margin-left: 20px;
        }
    </style>
</head>
<body>
<div class="w3-container w3-card w3-white w3-round w3-margin">
    <?php 
    session_start();
    $user_id_logging = $_SESSION['user_id'];
    $userDatalogging = get_user_data($user_id_logging, $connect);
    ?>
    <div class="container">
        <h1>Student Help System</h1>

        <!-- Display List of Questions/Posts -->
        <div class="question-list" id="question-list">
        <table border=1>
        <tr>
            <th colspan=5><h3> Question </h3> </th>
        </tr>
        <tr>
            <th>Question Id</th>
            <th>User Name</th>
            <th>Module Name</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th>Date</th>
            
            <th>Vote</th>
        </tr>
        

        <tr>
            <td><?= $question['question_id']?></td>
            <td><?= $question['user_name']?></td>
            <td><?= $question['module_name']?></td>
            <td><?= $question['title']?></td>
            <td><?= $question['content']?></td>
            <td>
                <?php if ($question['image']) { ?>
                <img src="images/<?= $question['image'] ?>" width="100" height="100">
                <?php } ?>
            </td>
            <td>
                <?= $question['date']?>
                <?= $question['time']?>
                
            </td>
            <td>
                <?php 
                $user_vote_question = "SELECT * FROM vote WHERE user_id = ? AND question_id = ?";
                $check_stmt = $connect->prepare($user_vote_question);
                $check_stmt->bindParam(1, $user_id_logging, PDO::PARAM_INT);
                $check_stmt->bindParam(2, $question['question_id'], PDO::PARAM_INT);
                $check_stmt->execute();
                // Check if there is a matching row in the vote table
                $is_voted = $check_stmt->fetch(PDO::FETCH_ASSOC);
                 ?>
                <form action="increase_vote.php" method='post'>
                    <input type="hidden" name='question_id' value=<?= $question['question_id']?>>
                    <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>

                    <?php if($question['user_id'] == $user_id_logging ) { ?>
            <!-- Display alert if user tries to vote for themselves -->
                    <button  class="vote-btn" onclick="alert('You can\'t vote for yourself.'); return false;">+</button>
                    
                    <?php } elseif($is_voted == True) { ?>
                    <button  class="vote-btn" onclick="alert('You have already voted for this question.'); return false;">+</button>
                    <?php } else {?>
                        <button type="submit" name="plus" class="vote-btn" data-vote-type="up">+</button>
                        
                        <?php 
                        
                    } ?>
                </form>
            
            <span class="vote-count" row="5" height="5">    </span> <!-- Placeholder for displaying vote count -->
            <form action="decrease_vote.php" method='post'>
                    <input type="hidden" name='question_id' value=<?= $question['question_id']?>>
                    <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
                    
                    <button type="submit" name="minus" class="vote-btn" data-vote-type="up">-</button>
                </form>
            </td>
            <form action="save_question.php" method="post">
                <input type="hidden" name="question_id" value="<?= $question['question_id']?>">
                <input type="hidden" name="user_id" value="<?= $user_id_logging?>">
                <input type="submit" value="Save">
            </form>
            <?php 
            $view_count = update_view_count($connect, $question['question_id']);
            
            if ($user_id_logging == $question['user_id']) { ?>
            <form action="delete_question.php" method="post">
                <input type="hidden" name="question_id" value="<?= $question['question_id']?>">
                <input type="submit" value="Delete" onclick="return confirm('Are you sure to delete this question ?');">
            </form>
            

            <form action="edit_question.php" method="post">
                <input type="hidden" name="question_id" value="<?= $question['question_id']?>">
                <input type="submit" value="Edit" >
            </form>
            <?php
            }
             ?>
            
            
        </tr>
        
        </table>
        </div>
    </div>

    <h1>Comments</h1>
    

    <!-- Example comments -->
    <?php foreach ($comments as $comment): ?>

        <?php 
                $user_vote_comment = "SELECT * FROM vote_comment WHERE user_id = ? AND comment_id = ?";
                $check_stmt = $connect->prepare($user_vote_comment);
                $check_stmt->bindParam(1, $user_id_logging, PDO::PARAM_INT);
                $check_stmt->bindParam(2, $comment['comment_id'], PDO::PARAM_INT);
                $check_stmt->execute();
                // Check if there is a matching row in the vote table
                $is_voted_comment = $check_stmt->fetch(PDO::FETCH_ASSOC);
                 ?>

    <div class="comment">
        <div class="author"><?= $comment['user_name'] ?>:
        </div>
        <div class="content">
            <?= $comment['comment_content'] ?>
        </div>
        <?= $comment['date'] ?>
        <?= $comment['time'] ?> <br>
        <?php if( $comment['image']) {?>
        <img src="images/<?= $comment['image'] ?>" width="100" height="100"><br>
        <?php } ?>

        <form action="increase_vote_comment.php" method='post'>
            <input type="hidden" name='comment_id' value=<?= $comment['comment_id']?>>
            <input type="hidden" name='user_id_comment' value=<?= $comment['user_id']?>>
            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
            <?php if($comment['user_id'] == $user_id_logging ) { ?>
                <!-- Display alert if user tries to vote for themselves -->
                <button  class="vote-btn" onclick="alert('You can\'t vote for yourself.'); return false;">+</button>
            <?php } elseif ($is_voted_comment == True) {?>
                <button  class="vote-btn" onclick="alert('You have already voted for this comment.'); return false;">+<button>
                <?php } else {?>
                <!-- Normal button for voting -->
                <button type="submit" name="plus" class="vote-btn" data-vote-type="up">+</button>
            <?php } ?>
        </form>
            
            <span class="vote-count" row="5" height="5">    </span> 
            <!-- Placeholder for displaying vote count -->
        <form action="decrease_vote_comment.php" method='post'>
                    <input type="hidden" name='comment_id' value=<?= $comment['comment_id']?>>
                    <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
                    <button type="submit" name="minus" class="vote-btn" data-vote-type="up">-</button>
        </form>
                <?php 
    // Check if the logged-in user is the owner of the comment
    if ($user_id_logging == $comment['user_id']) { ?>
    <!-- Edit Button -->
    <form action="edit_comment.php" method="post">
        <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
        <input type="submit" value="Edit">
        
    </form>
    <!-- Delete Button -->
    <form action="delete_comment.php" method="post">
        <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
        <input type="hidden" name="question_id" value="<?= $question['question_id'] ?>">
        
        <input type="submit" name="delete_comment" value="Delete" onclick="return confirm('Are you sure you want to delete this comment?')">
    </form>
    <?php } ?>
    <form action="save_comment.php" method="post">
                <input type="hidden" name="comment_id" value="<?= $comment['comment_id']?>">
                <input type="hidden" name="user_id" value="<?= $user_id_logging?>">
                <input type="submit" name="save_comment" value="Save">
    </form>   

    <!-- show comment reply -->
    <?php $comments_rep = getCommentReplies($connect, $comment['comment_id']) ?>

    
    <?php foreach ($comments_rep as $comment_rep): ?>
        <?php  
                $user_vote_comment_rep = "SELECT * FROM vote_comment_rep WHERE user_id = ? AND comment_rep_id = ?";
                $check_stmt = $connect->prepare($user_vote_comment_rep);
                $check_stmt->bindParam(1, $user_id_logging, PDO::PARAM_INT);
                $check_stmt->bindParam(2, $comment_rep['comment_rep_id'], PDO::PARAM_INT);
                $check_stmt->execute();
                // Check if there is a matching row in the vote table
                $is_voted_comment_rep = $check_stmt->fetch(PDO::FETCH_ASSOC);
                 ?> 

    <div class="comment" style="font-size: 12px; text-align: right;">
        <div class="author"><?= $comment_rep['user_name'] ?>:
        </div>
        <div class="content">
                <?= $comment_rep['content'] ?>
        </div>
        <?= $comment_rep['date'] ?>
        <?= $comment_rep['time'] ?> <br>
        <?php if( $comment_rep['image']) {?>
        <img src="images/<?= $comment_rep['image'] ?>" width="100" height="100"><br>
        <?php } ?>

        <form action="increase_vote_comment.php" method='post'>
            <input type="hidden" name='comment_id' value=<?= $comment_rep['comment_id']?>>
            <input type="hidden" name='comment_rep_id' value=<?= $comment_rep['comment_rep_id']?>>
            <input type="hidden" name='user_id_comment_rep' value=<?= $comment_rep['user_id']?>>
            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
            <?php if($comment_rep['user_id'] == $user_id_logging ) { ?>
                <!-- Display alert if user tries to vote for themselves -->
                <button  class="vote-btn" onclick="alert('You can\'t vote for yourself.'); return false;">+</button>
            <?php } elseif ($is_voted_comment_rep == True) {?>
                <button  class="vote-btn" onclick="alert('You have already voted for this comment reply.'); return false;">+<button>
                <?php } else {?>
                <!-- Normal button for voting -->
                <button type="submit" name="plus_comment_rep" class="vote-btn" data-vote-type="up">+</button>
            <?php } ?>
        </form>
            
            <span class="vote-count" row="5" height="5">    </span> 
            <!-- Placeholder for displaying vote count -->
        <form action="decrease_vote_comment.php" method='post'>
            <input type="hidden" name='comment_id' value=<?= $comment_rep['comment_id']?>>
            <input type="hidden" name='comment_rep_id' value=<?= $comment_rep['comment_rep_id']?>>
            <input type="hidden" name='user_id_comment_rep' value=<?= $comment_rep['user_id']?>>
            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
                <button type="submit" name="minus_comment_rep" class="vote-btn" data-vote-type="up">-</button>
        </form>
                <?php 
    // Check if the logged-in user is the owner of the comment
    if ($user_id_logging == $comment_rep['user_id']) { ?>
    <!-- Edit Button -->
    <form action="edit_comment_rep.php" method="post">
        <input type="hidden" name="comment_rep_id" value="<?= $comment_rep['comment_rep_id'] ?>">
        <input type="submit"  value="Edit">
        
    </form>
    <!-- Delete Button -->
    <form action="delete_comment.php" method="post">
        <input type="hidden" name="comment_rep_id" value="<?= $comment_rep['comment_rep_id'] ?>">
        <input type="submit" name='delete_comment_rep' value="Delete" onclick="return confirm('Are you sure you want to delete this comment reply?')">
    </form>
    <?php } ?>
    
    </div>
    <?php endforeach; ?>
    
    <!-- post comment reply -->
    <div class="container mt-5">
        
        <form  action="post_comment_rep.php" method="post" enctype="multipart/form-data">
            <!-- Comment Content -->
            <div class="form-group">
                
                <input type="text" class="form-control" id="comment" rows="3" height="5" placeholder="Add a comment here" name="comment_rep_content" required>
            </div>
            Select image to upload:
            <input type="file" name="fileToUploadRep" id="fileToUploadRep"> <br> <br>
            <!-- Hidden input field to store the date -->
            <input type="hidden" name="date" value="<?= date('Y-m-d') ?>">
            <input type="hidden" name="question_id" value=<?=$question['question_id']?>>
            <input type="hidden" name="comment_id" value=<?=$comment['comment_id']?>>
            <!-- Submit Button -->
            <input type="submit" class="btn btn-primary" name="post" value="Add comment">
        </form>
    </div>

</div>
    
    

    <?php endforeach; ?>


<div class="container mt-5">
        <h2>Post Your Answer</h2>
        <form  action="post_comment.php" method="post" enctype="multipart/form-data">
            <!-- Comment Content -->
            <div class="form-group">
                <label for="comment">Your Comment</label>
                <input type="text" class="form-control" id="comment" rows="3" height="5" placeholder="Type your comment here" name="comment_content" required>
            </div>
            Select image to upload:
            <input type="file" name="fileToUploadAnswer" id="fileToUploadAnswer"> <br> <br>
            <!-- Hidden input field to store the date -->
            <input type="hidden" name="date" value="<?= date('Y-m-d') ?>">
            <input type="hidden" name="question_id" value=<?=$question['question_id']?>>
            <!-- Submit Button -->
            
            <input type="submit" class="btn btn-primary" name="post" value="Post Your Answer">
        </form>
</div>
</div>

    <!-- Script for handling question display and comment/reaction submission -->
    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript to set current date -->
    
</body>
</html>