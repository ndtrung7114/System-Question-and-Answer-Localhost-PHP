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
      <form id="resetForm" action="../index_mail.php" method="post" >
        <hr>
        Enter your email address and we will send you a password reset
        <hr>
        
        <label id="icon" for="name"><i class="fas fa-envelope"></i></label>
        <input type="text" name="email"  placeholder="Email" required/>
        
        
        <?php 
        $random_number = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        session_start();
            $_SESSION['otp_email'] = $random_number;
            
            
         ?>

        
        <hr>
        <div class="btn-block">
          <input type="hidden" name='otp_email' value='<?= $_SESSION['otp_email'] ?>'>
          
          <button type="submit" name="reset">Send password reset email</button>
        </div>
        <hr>
        <a href="register.html.php">Back to login</a>
      </form>
    </div>
    

  
  </body>
</html>
