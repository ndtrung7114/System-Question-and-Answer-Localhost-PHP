<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question List</title>
    <link rel="stylesheet" href="../../css/view_question.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        .vote-btn {
        border: none;
        background: none;
        padding: 10; /* Remove padding */
        cursor: pointer;
        /* Add any additional styles as needed */
    }
    
    
    </style>
</head>
<body>
<div class="w3-container w3-card w3-white w3-round w3-margin">
    <?php 
    
    list($user_id_logging, $userDatalogging) = getUserData($connect);
    ?>
    
    
        
    <div class="card">
        <div class="d-flex justify-content-between p-2 px-3">
            <div class="d-flex flex-row align-items-center"> <img src="../../images/<?= $question['avatar'] ?>" width="50" class="rounded-circle">
                <div class="d-flex flex-column ml-2"> <span class="font-weight-bold"><?= $question['user_name']?></span> <small class="text-primary"><?= $question['title']?></small> 
                </div>

                      
                </div> 
                    
                <div class="d-flex flex-row mt-1 ellipsis"> <small class="mr-2"><?= $question['time']?> <br> <?= $question['date']?> </small> 
                       
                         
                
                
                
                
                    </div>
                </div> <?php if ($question['image']) { ?>
                <img src="../../images/<?= $question['image'] ?>" class="img-fluid">
                <?php } ?> 
                <div class="p-2">
                    <h4><p class="text-justify"><?= $question['content']?></p></h4>
                <?php 
                $user_vote_question = "SELECT * FROM vote WHERE user_id = ? AND question_id = ?";
                $check_stmt = $connect->prepare($user_vote_question);
                $check_stmt->bindParam(1, $user_id_logging, PDO::PARAM_INT);
                $check_stmt->bindParam(2, $question['question_id'], PDO::PARAM_INT);
                $check_stmt->execute();
                // Check if there is a matching row in the vote table
                $is_voted = $check_stmt->fetch(PDO::FETCH_ASSOC);
                 ?>
                    <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-row icons d-flex align-items-center"> 
                        <form action="../../php_admin/update/increase_vote.php" method='post'>
                            <input type="hidden" name='question_id' value=<?= $question['question_id']?>>
                            <input type="hidden" name='question_id_user' value=<?= $question['user_id']?>>
                            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>

                            <?php if($question['user_id'] == $user_id_logging ) { ?>
                    <!-- Display alert if user tries to vote for themselves -->
                            <button  class="vote-btn" onclick="alert('You can\'t vote for yourself.'); return false;"><i class="fa-regular fa-thumbs-up"></i></button>
                            
                            <?php } elseif($is_voted == True) { ?>
                            <button  class="vote-btn" onclick="alert('You have already voted for this question.'); return false;"><i class="fa-regular fa-thumbs-up"></i></button>
                            <?php } else {?>
                                <button type="submit" name="plus" class="vote-btn" data-vote-type="up"><i class="fa-regular fa-thumbs-up"></i>  </button> 
                                
                                <?php 
                                
                            } ?>
                        </form>
            
                        <span class="vote-count" row="10" height="10"> <?php= $question['vote'] ?></span> <?= $question['vote'] ?>
                        <form action="../../php_admin/update/decrease_vote.php" method='post'>
                                <input type="hidden" name='question_id' value=<?= $question['question_id']?>>
                                <input type="hidden" name='question_id_user' value=<?= $question['user_id']?>>
                                <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
                                
                                <button type="submit" name="minus" class="vote-btn" data-vote-type="up"><i class="fa-regular fa-thumbs-down"></i></button>
                        </form>

                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="questionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="questionDropdown">
                            <form action="../../php_admin/create/save_question.php" method="post">
                            <input type="hidden" name="question_id" value="<?= $question['question_id']?>">
                            <input type="hidden" name="user_id" value="<?= $user_id_logging?>">
                            <input type="submit" style="border-radius: 10px;" class="w3-button w3-theme-d2 w3-margin-bottom" value="Save">
                            </form>
                            <?php 
                            $view_count = update_view_count($connect, $question['question_id']);
                            
                            if ($user_id_logging == $question['user_id']) { ?>
                            <form action="../../php_admin/delete/delete_question.php" method="post">
                                <input type="hidden" name="question_id" value="<?= $question['question_id']?>">
                                <input type="submit" style="border-radius: 10px;" class="w3-button w3-theme-d2 w3-margin-bottom" value="Delete" onclick="return confirm('Are you sure to delete this question ?');">
                            </form>
                            

                            <form action="../../php_admin/update/edit_question.php" method="post">
                                <input type="hidden" name="question_id" value="<?= $question['question_id']?>">
                                <input type="submit" style="border-radius: 10px;" class="w3-button w3-theme-d2 w3-margin-bottom" value="Edit" >
                            </form>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    
                        
                    
                </div>
                    <hr>
                    
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
        <span class="w3-right w3-opacity"><?php echo $comment['date']; ?></span> <br>
          <span class="w3-right w3-opacity"><?php echo $comment['time']; ?></span>
            <img src="../../images/<?= $comment['avatar'] ?>" width="50" height="50" class="rounded-circle"><br>
            <div class="author"><?= $comment['user_name'] ?>:
            </div>
            <div class="content">
            <h4><?= $comment['comment_content'] ?></h4>
            </div>
            
            <?php if( $comment['image']) {?>
            <img src="../../images/<?= $comment['image'] ?>" width="100" height="100"><br>
            <?php } ?>
            <hr>

            <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-row icons d-flex align-items-center">
            <form action="../../php_admin/update/increase_vote_comment.php" method='post'>
                <input type="hidden" name='comment_id' value=<?= $comment['comment_id']?>>
                <input type="hidden" name='user_id_comment' value=<?= $comment['user_id']?>>
                <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
                <?php if($comment['user_id'] == $user_id_logging ) { ?>
                    <!-- Display alert if user tries to vote for themselves -->
                    <button  class="vote-btn" onclick="alert('You can\'t vote for yourself.'); return false;"><i class="fa-regular fa-thumbs-up"></i></button>
                <?php } elseif ($is_voted_comment == True) {?>
                    <button  class="vote-btn" onclick="alert('You have already voted for this comment.'); return false;"><i class="fa-regular fa-thumbs-up"></i><button>
                    <?php } else {?>
                    <!-- Normal button for voting -->
                    <button type="submit" name="plus" class="vote-btn" data-vote-type="up"><i class="fa-regular fa-thumbs-up"></i></button>
                <?php } ?>
            </form>
            
            <span class="vote-count" row="5" height="5"> <?= $comment['vote'] ?>   </span> 
            <!-- Placeholder for displaying vote count -->
            <form action="../../php_admin/update/decrease_vote_comment.php" method='post'>
                        <input type="hidden" name='comment_id' value=<?= $comment['comment_id']?>>
                        <input type="hidden" name='user_id_comment' value=<?= $comment['user_id']?>>
                        <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
                        <button type="submit" name="minus" class="vote-btn" data-vote-type="up"><i class="fa-regular fa-thumbs-down"></i></button>
            </form>
            </div>
            <div class="dropdown">
            <button class="btn btn-secondary comment-dropdown-toggle" type="button" id="commentDropdown<?= $comment['comment_id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa-solid fa-ellipsis"></i>
        </button>
        <div class="dropdown-menu comment-dropdown-menu menu-left" aria-labelledby="commentDropdown<?= $comment['comment_id'] ?>">
                            
                <?php 
    // Check if the logged-in user is the owner of the comment
                if ($user_id_logging == $comment['user_id']) { ?>
                <!-- Edit Button -->
                <form action="../../php_admin/update/edit_comment.php" method="post">
                    <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
                    <input type="submit" style="border-radius: 10px;" class="w3-button w3-theme-d2 w3-margin-bottom" value="Edit">
                    
                </form>
    <!-- Delete Button -->
                <form action="../../php_admin/delete/delete_comment.php" method="post">
                    <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
                    <input type="hidden" name="question_id" value="<?= $question['question_id'] ?>">
                    
                    <input type="submit" name="delete_comment" style="border-radius: 10px;" class="w3-button w3-theme-d2 w3-margin-bottom" value="Delete" onclick="return confirm('Are you sure you want to delete this comment?')">
                </form>
                <?php } ?>
                <form action="../../php_admin/create/save_comment.php" method="post">
                            <input type="hidden" name="comment_id" value="<?= $comment['comment_id']?>">
                            <input type="hidden" name="user_id" value="<?= $user_id_logging?>">
                            <input type="submit" name="save_comment" style="border-radius: 10px;" class="w3-button w3-theme-d2 w3-margin-bottom" value="Save">
                </form> 
                </div>
                
                </div>  
                
                    </div>
                    <hr>
                    
            

            

    <!-- show comment reply -->
                <?php $comments_rep = getCommentReplies($connect, $comment['comment_id']) ?>

    
                <?php foreach ($comments_rep as $comment_rep): ?>
                    

            <div class="comment" style="font-size: 12px; text-align: right;">
                <img src="../../images/<?= $comment_rep['avatar'] ?>" width="30" height="30" class="rounded-circle"><br>
                <div class="author"><?= $comment_rep['user_name'] ?>:
                </div>
                <div class="content">
                <h5><?= $comment_rep['content'] ?> </h5>
                </div>
                 <small class="mr-2" style='color: #a09c9c'>
                <?= $comment_rep['date'] ?>
                <?= $comment_rep['time'] ?> </small> <br>
                <?php if( $comment_rep['image']) {?>
                <img src="../../images/<?= $comment_rep['image'] ?>" width="100" height="100"><br>
                <?php } ?> <br>

                <div class="dropdown">
                <button class="btn btn-secondary comment-rep-dropdown-toggle" type="button" id="commentRepDropdown<?= $comment_rep['comment_rep_id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid fa-ellipsis"></i>
        </button>
        <div class="dropdown-menu comment-rep-dropdown-menu dropdown-menu-right" aria-labelledby="commentRepDropdown<?= $comment_rep['comment_rep_id'] ?>">
                        <?php 
            // Check if the logged-in user is the owner of the comment
            if ($user_id_logging == $comment_rep['user_id']) { ?>
            <!-- Edit Button -->
            <form action="../../php_admin/update/edit_comment_rep.php" method="post">
                <input type="hidden" name="comment_rep_id" value="<?= $comment_rep['comment_rep_id'] ?>">
                <input type="submit" style="border-radius: 10px;" class="w3-button w3-theme-d2 w3-margin-bottom"  value="Edit">
                
            </form>
            <!-- Delete Button -->
            <form action="../../php_admin/delete/delete_comment.php" method="post">
                <input type="hidden" name="comment_rep_id" value="<?= $comment_rep['comment_rep_id'] ?>">
                <input type="submit" style="border-radius: 10px;" class="w3-button w3-theme-d2 w3-margin-bottom" name='delete_comment_rep' value="Delete" onclick="return confirm('Are you sure you want to delete this comment reply?')">
            </form>
            <?php } ?>
            </div>
            </div>
            
            </div> <!--end 1 comment -->
            <?php endforeach; ?>
            
    
    <!-- post comment reply -->
    <div class="container mt-5">
        
        <form  action="../../php_admin/create/post_comment_rep.php" method="post" enctype="multipart/form-data">
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
            <input type="hidden" name="user_id_question" value=<?=$question['user_id']?>>
            <!-- Submit Button -->
            <input type="submit" class="btn btn-primary" name="post" value="Add comment">
        </form>
    </div>

</div>
    
    

    <?php endforeach; ?>


<div class="container mt-5">
        <h2>Post Your Answer</h2>
        <form  action="../../php_admin/create/post_comment.php" method="post" enctype="multipart/form-data">
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
            <input type="hidden" name="user_id_question" value=<?=$question['user_id']?>>
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
    <script>
    // Get dropdown buttons and menus for each dropdown
    var questionDropdownButton = document.querySelector('#questionDropdown');
    var questionDropdownMenu = document.querySelector('#questionDropdown + .dropdown-menu');
    
    var commentDropdownButtons = document.querySelectorAll('.comment-dropdown-toggle');
    var commentDropdownMenus = document.querySelectorAll('.comment-dropdown-menu');
    
    var commentRepDropdownButtons = document.querySelectorAll('.comment-rep-dropdown-toggle');
    var commentRepDropdownMenus = document.querySelectorAll('.comment-rep-dropdown-menu');

    // Add click event listeners to the dropdown buttons
    questionDropdownButton.addEventListener('click', function() {
        // Toggle the 'show' class on the dropdown menu for questions
        questionDropdownMenu.classList.toggle('show');
    });

    commentDropdownButtons.forEach(function(button, index) {
        button.addEventListener('click', function() {
            // Toggle the 'show' class on the corresponding comment dropdown menu
            commentDropdownMenus[index].classList.toggle('show');
        });
    });

    commentRepDropdownButtons.forEach(function(button, index) {
        button.addEventListener('click', function() {
            // Toggle the 'show' class on the corresponding comment reply dropdown menu
            commentRepDropdownMenus[index].classList.toggle('show');
        });
    });
</script>
</body>
</html>