<?php
    session_start();
    list($user_id_logging, $userDatalogging) = getUserData($connect);?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="../../css/profile_user.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Document</title>
    <style>
        .profile-edit-btn {
    width: 120px;
    border-radius: 5px; /* Adjust the width as needed */
}
    </style>
    
</head>
<body>
<?php $day_since_creation = elapsedTimeSinceCreation($infors['create_at']) ?>
<div class="w3-container w3-card w3-white w3-round w3-margin">
    <div class="container emp-profile">

        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                                    <img src="../../images/<?= $infors['avatar'] ?>" alt=""/>
                  
                </div>
            </div>
                
            <div class="col-md-6">
                <div class="profile-head">
                                            <h5>
                                                <?= $infors['user_name'] ?>
                                            </h5>
                                            <h6>
                                            <?= $infors['job'] ?>
                                            </h6>
                                            <h6>
                                            <?= $infors['country'] ?>
                                            </h6>
                                            <p class="proile-rating">Birth : <?= $infors['birth'] ?></p>
                                            <p class="proile-rating">Member for <?= $day_since_creation ?>  </p>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                        <form action="../../php_admin/read/profile_user.php" method="post">
                                            <input type="hidden" name="user_id" value="<?= $infors['user_id']; ?>">
                                            
                                            <input type="submit" name="view_user" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="About"> 
                    
                                        </form>
                                        </li>
                                        <li class="nav-item">
                                        <form action="../../php_admin/read/activity.php" method="post">
                                            <input type="hidden" name="user_id" value="<?= $infors['user_id']; ?>">
                                            
                                            <input type="submit" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="Activity"> 
                    
                                        </form>
                                        </li>
                                    </ul>
                </div>
            </div>
            <div class="col-md-2">
            <form action="../../php_admin/update/edit_profile.php" method="post">
                
                    <input type="hidden" name='user_id' value='<?= $infors['user_id']?> '>
                        <input type="submit" class="profile-edit-btn" value="Edit Profile"/>
                        
                </form>
                <br>
                <form action="../../php_admin/delete/delete_profile.php" method="post">
                
                    <input type="hidden" name='user_id' value='<?= $infors['user_id']?> '>
                        <input type="submit" class="profile-edit-btn" value="Delete Profile" onclick="return confirm('Are you sure to delete this user ?');">
                        
                </form><br>


                <form action="../../php_admin/update/change_password.php" method='post'>
                
                    <input type="hidden" name='user_id' value='<?= $infors['user_id']?>'>
    
                    <input type="submit" class="profile-edit-btn" value='Change password'>
                    
</form>

                        
            </div>
        </div>

        <div class="row">
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
                        <th class="text-center" style="width: 20%;">Answers</th>
                        <th class="text-center" style="width: 20%;">Questions</th>
                    </tr>

                    <tr>
                        <td>
                            <?php foreach ($sql_user_question as $question): ?>
                                                <form action="../../php_admin/read/view_question.php" method="post">
                                            <input type="hidden" name="question_id" value="<?= $question['question_id']; ?>">
                                            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>

                                            <?php 
                                            $content = $question['content'];
                            // Limit content length to 50 characters
                                            $truncated_content = strlen($content) > 10 ? substr($content, 0, 10) . '...' : $content;
                                            ?>
                                            <input type="submit" class="proile-rating" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="<?= $truncated_content ?> -- <?= $question['date']; ?>"> 
                                            
                                                </form>
                                                
                            <?php endforeach; ?>
                            
                        </td>

                        <td>
                            <?php foreach ($sql_user_comment as $comment): ?>
                                                <form action="../../php_admin/read/view_question.php" method="post">
                                            <input type="hidden" name="question_id" value="<?= $comment['question_id']; ?>">
                                            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>

                                            <?php 
                                            $content = $comment['comment_content'];
                            // Limit content length to 50 characters
                                            $truncated_content = strlen($content) > 10 ? substr($content, 0, 10) . '...' : $content;
                                            ?>
                                            <input type="submit" class="proile-rating" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="<?= $truncated_content ?> -- <?= $comment['date']; ?>"> 
                                            
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


