<?php
    session_start();
    $user_id_logging = $_SESSION['user_id'];
    $userDatalogging = get_user_data($user_id_logging, $connect);?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="../profile_user.css" rel="stylesheet">
   
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Document</title>
    
</head>
<body>
<div class="w3-container w3-card w3-white w3-round w3-margin">
    <div class="container emp-profile">

        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                                    <img src="../images/<?= $infors['avatar'] ?>" alt=""/>
                    <div class="file btn btn-lg btn-primary">
                                        Change Photo
                                        <input type="file" name="file"/>
                    </div>
                </div>
            </div>
                
            <div class="col-md-6">
                <div class="profile-head">
                                            <h5>
                                                <?= $infors['name'] ?>
                                            </h5>
                                            <h6>
                                            <?= $infors['job'] ?>
                                            </h6>
                                            <h6>
                                            <?= $infors['country'] ?>
                                            </h6>
                                            <p class="proile-rating">Birth : <?= $infors['birth'] ?></p>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                        <form action="profile_user.php" method="post">
                                            <input type="hidden" name="user_id" value="<?= $infors['user_id']; ?>">
                                            
                                            <input type="submit" name="view_user" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="About"> 
                    
                                        </form>
                                        </li>
                                        <li class="nav-item">
                                        <form action="activity.php" method="post">
                                            <input type="hidden" name="user_id" value="<?= $infors['user_id']; ?>">
                                            
                                            <input type="submit" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="Activity"> 
                    
                                        </form>
                                        </li>
                                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                                
                                <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                                
            </div>

            
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-6">
                                                <label>Reputation</label>
                                                <label>Questions</label>
                                    
                                                <label>Comments</label>
                    </div>
                    <div class="col-md-6">
                                                <p><?= $infors['reputation'] ?></p>
                                                <p><?= $count_user_question ?></p>
                                                <p><?= $count_user_comment ?></p>
                    </div>
                </div>
            </div>
            
                
                                  
            <div class="col-md-8">
                <table border=1>
                    <tr>
                        <th width="20">Question</th>
                        <th width="20">Answer</th>
                    </tr>

                    <tr>
                        <td>
                            <?php foreach ($sql_user_question as $question): ?>
                                                <form action="view_question.php" method="post">
                                            <input type="hidden" name="question_id" value="<?= $question['question_id']; ?>">
                                            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>

                                            <?php 
                                            $content = $question['content'];
                            // Limit content length to 50 characters
                                            $truncated_content = strlen($content) > 10 ? substr($content, 0, 10) . '...' : $content;
                                            ?>
                                            <input type="submit" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="<?= $truncated_content ?> -- <?= $question['date']; ?>"> 
                                            
                                                </form>
                                                
                            <?php endforeach; ?>
                            
                        </td>

                        <td>
                            <?php foreach ($sql_user_comment as $comment): ?>
                                                <form action="view_question.php" method="post">
                                            <input type="hidden" name="question_id" value="<?= $comment['question_id']; ?>">
                                            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>

                                            <?php 
                                            $content = $comment['comment_content'];
                            // Limit content length to 50 characters
                                            $truncated_content = strlen($content) > 10 ? substr($content, 0, 10) . '...' : $content;
                                            ?>
                                            <input type="submit" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="<?= $truncated_content ?> -- <?= $comment['date']; ?>"> 
                                            
                                                </form>
                                                
                            <?php endforeach; ?>
                            
                        </td>
                    </tr>


                </table>
                
                    
                                        
                                        
                                        
                    
            </div>
            
        </div>
    </div>                                    
</div>

        <!-- <script>
    $(document).ready(function() {
        // Load initial content
        $('#home').addClass('show active'); // Show the "About" content by default

        // Event listener for tab clicks
        $('#home-tab').click(function(e) {
            e.preventDefault();
            $('#home').addClass('show active');
            $('#profile').removeClass('show active');
        });

        $('#profile-tab').click(function(e) {
            e.preventDefault();
            $('#profile').addClass('show active');
            $('#home').removeClass('show active');
        });
    });
</script> -->
</body>
</html>


