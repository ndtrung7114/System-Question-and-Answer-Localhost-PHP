<?php 
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="w3-container w3-card w3-white w3-round w3-margin">
    <div class="container">
        <h1 class="mt-4">Edit your profile</h1>
        <form action="../../php_admin/update/edit_profile.php" method="post" enctype="multipart/form-data">
            <div class="card mb-4">
                <div class="card-body">
                    <h4>Public information</h4>
                    <div class="form-group">
                        <label for="profileImage">Profile image</label>
                        <div class="profile-img">
                            <img src="../../images/<?= $profile['avatar'] ?>" alt="Profile Image" class="img-fluid">
                            <label class="btn btn-primary btn-sm ml-2">
                                Change Photo
                                <input type="file" name="fileToUpload" id="profileImage" style="display: none;">
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userName">User name</label>
                        <input type="text" name="user_name" id="userName" class="form-control" value="<?= $profile['user_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="country" id="location" class="form-control" value="<?= $profile['country'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="job">Job</label>
                        <input type="text" name="job" id="job" class="form-control" value="<?= $profile['job'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="birth">Birth</label>
                        <input type="date" name="birth" id="birth" class="form-control" value="<?= $profile['birth'] ?>">
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h4>Links</h4>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= $profile['email'] ?>">
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h4>Private information</h4>
                    <p class="text-muted">Not shown to public</p>
                    <div class="form-group">
                        <label for="trueName">Truth name</label>
                        <input type="text" name="name" id="trueName" class="form-control" value="<?= $profile['name'] ?>">
                    </div>
                </div>
            </div>
            <input type="hidden" name="user_id" value="<?= $profile['user_id'] ?>">
            <input type="hidden" name="old_avt" value="<?= $profile['avatar'] ?>">
            <button type="submit" name="edit_profile" class="btn btn-success btn-block">Save Change</button>
        </form>
    </div>
    </div>
</body>
</html>

