<!DOCTYPE html>
<html>
  <head>
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/register.css">
  </head>
  <style>
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
  <body>
    <div class="main-block">
      <h1>Enter OTP</h1>
      <form action="../../php_users/register/otp.php" method="post">
        
        
        
        <input type="text" name="otp_user"  placeholder="OTP" required/>
        
        
        

        
        <hr>
        <div class="btn-block">
          
          <button type="submit" name="continue">Continue</button>
        </div>
        <hr>
        <a href="register.html.php">Back to loggin</a>
      </form>
    </div>
  </body>
</html>
