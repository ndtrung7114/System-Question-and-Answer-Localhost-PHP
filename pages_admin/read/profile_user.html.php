
    
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
<?php $day_since_creation = elapsedTimeSinceCreation($infors['create_at']) ?>
<body>
<div class="w3-container w3-card w3-white w3-round w3-margin">
    <div class="container emp-profile">
            <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                            <img src="../../images/<?= $infors['avatar'] ?>" alt=""/>
                    <!-- <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                    </div> -->
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
                                    
                                    <input class="nav-link active" type="submit" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="About"> 
            
                                </form>
                                </li>
                                <li class="nav-item">
                                <form action="../../php_admin/read/activity.php" method="post">
                                    <input type="hidden" name="user_id" value="<?= $infors['user_id']; ?>">
                                    
                                    <input class="nav-link active" type="submit" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; text-decoration: none;" value="Activity"> 
            
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
                    
                </form><br>

                <form action="../../php_admin/update/set_user_admin.php" method='post'>
               
                    <input type="hidden" name='user_id' value='<?= $infors['user_id']?>'>
    
                    <input type="submit" class="profile-edit-btn" value='Set Admin'>
                    
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
            <div class="tab-content profile-tab" id="myTabContent">
                
                    <div class="row">
                        <div class="col-md-6">
                                                <label>User Id</label>
                        </div>
                        <div class="col-md-6">
                                                <p><?= $infors['user_id'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                                                <label>User_name</label>
                        </div>
                        <div class="col-md-6">
                                                <p><?= $infors['user_name'] ?></p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $infors['email'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Country</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $infors['country'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Profession</label>
                        </div>
                        <div class="col-md-6">
                            <p><?= $infors['job'] ?></p>
                        </div>
                    </div>
                
            </div>
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


