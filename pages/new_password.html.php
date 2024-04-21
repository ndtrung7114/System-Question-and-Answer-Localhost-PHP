<!DOCTYPE html>
<html>
  <head>
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/register.css">
  </head>
  <body>
    <div class="main-block">
      <h1>Reset Password</h1>
      <form id="resetForm" action="new_password.php" method="post" onsubmit="return validatePasswords()">
        
        <label id="icon" for="name"><i class="fas fa-unlock-alt"></i></label>
        <input type="password" id="newPassword" name="new_password"  placeholder="New password" required/>

        <label id="icon" for="name"><i class="fas fa-unlock-alt"></i></label>
        <input type="password" id="confirmPassword" name="confirm_password"  placeholder="Confirm new password" required/>
        <hr>
        
        <div class="btn-block">
          <!-- <p>Don't have an account? <a href="sign_up.html.php">Sign Up</a></p> -->
          <button type="submit" name="save_change">Save Change</button>
        </div>
        <hr>
        Already have an account? <a href="pages/register.html.php">Sign In</a>
      </form>
    </div>

    <script>
      function validatePasswords() {
        var newPassword = document.getElementById("newPassword").value;
        var confirmPassword = document.getElementById("confirmPassword").value;
        
        if (newPassword !== confirmPassword) {
          alert("New password and confirm password do not match.");
          return false; // Prevent form submission
        }
        
        return true; // Allow form submission
      }
    </script>
  </body>
</html>
