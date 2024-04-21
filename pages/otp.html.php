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
      <h1>Enter OTP</h1>
      <form action="../otp.php" method="post">
        
        
        
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
