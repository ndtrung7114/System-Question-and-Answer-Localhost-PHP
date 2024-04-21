<?php 
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="edit_profile_user.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<form action="edit_profile.php" method="post" enctype="multipart/form-data">
<h1 style="color: black;">Edit your profile</h1>
<div class="w3-container w3-card w3-white w3-round w3-margin">
    

   

   <h4>Public information</h4>

   <label for=""> Profile image</label> <br>
   
                <div class="profile-img">
                            <img src="../images/<?= $profile['avatar'] ?>" alt=""/>
                    <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="fileToUpload"/>
                    </div>
                </div>
            

   <label for="">Display name</label> <br>
   <input type="text" name="name" required value="<?= $profile['name']?>"><br><br>
   <label for="">Location</label> <br>
   <input type="text" name="country" required value="<?= $profile['country']?>"><br><br>
   <label for="">About me</label><br>
   <input type="text" name="about me" required value="<?= $profile['job']?>"><br><br>



</div>
<div class="w3-container w3-card w3-white w3-round w3-margin">
    <h4>Links</h4> 
    <label for="">Email</label> <br>
    <input type="text" name="email" required value="<?= $profile['email']?>"><br><br>

</div>
<div class="w3-container w3-card w3-white w3-round w3-margin">
    <h4>Private information</h4> <h6>not show public</h6>
    <label for="">user name</label> <br>
    <input type="text" name="user_name" required value="<?= $profile['user_name']?>"><br><br>
    <label for="">Password</label> <br>
    <input type="text" name="password" required value="<?= $profile['password']?>"><br><br>

</div>

<input type="hidden" name="user_id" value="<?= $profile['user_id']?>">
<input type="submit" name="edit_profile" value='Save Change'>
    
</form>



</body>
</html>
