<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Module</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
<?php 
    session_start();
    $user_id_logging = $_SESSION['user_id'];
    $userDatalogging = get_user_data($user_id_logging, $connect);
?>
<div class="w3-container w3-card w3-white w3-round w3-margin">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center">Edit Module</h1>
                    <form action="../../php_admin/update/edit_module.php" method="post">
                        <div class="mb-3">
                            <label for="moduleName" class="form-label">Module Name</label>
                            <input type="text" name="module_name" id="moduleName" class="form-control" required value="<?= $module['module_name'] ?>">
                        </div>
                        <input type="hidden" name="module_id" value="<?= $module['module_id'] ?>">
                        <div class="text-center">
                            <input name="edit" type="submit" class="btn btn-primary" value="Edit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
