<!DOCTYPE html>
<html>
  <head>
    <title>Sign In</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/register.css">
    <style>
    /* CSS for background image */
    html, body {
      background-image: url('../../images/background.jpg'); /* Set the background image path */
      background-size: cover; /* Cover the entire viewport */
      background-position: center; /* Center the background image */
    }
    
    .main-block {
      background-color: rgba(255, 255, 255, 0.8); /* Add a semi-transparent white background for better readability */
      
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
    }
    
  </style>

  </head>
  <body>
    <div class="main-block">
      <h1>Sign In</h1>
      <form action="../../php_users/register/login.php" method="post">
        <hr>
        <div class="account-type">
          <input type="radio" value="user" id="radioOne" name="role" checked/>
          <label for="radioOne" class="radio">User</label>
          <input type="radio" value="admin" id="radioTwo" name="role" />
          <label for="radioTwo" class="radio">Admin</label>
        </div>
        <hr>
        <label id="icon" for="name"><i class="fas fa-envelope"></i></label>
        <input type="text" name="email"  placeholder="Email" required/>
       
        
        <label id="icon" for="name"><i class="fas fa-unlock-alt"></i></label>
        <input type="password" name="password"  placeholder="Password" required/>

        <a href="reset_password.html.php">forgot password?</a><br>
        <hr>
        
        
        <hr>
        <div class="btn-block">
          <p>Don't have an account? <a href="sign_up.html.php">Sign Up</a></p>
          <button type="submit" name="sign_in">Submit</button>
        </div>
      </form>
    </div>
  </body>
</html>
