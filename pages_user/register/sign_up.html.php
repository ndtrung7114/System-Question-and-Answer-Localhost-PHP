<!DOCTYPE html>
<html>
  <head>
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/register.css">
    <style>
      
        /* Style for the password strength indicator */
        #password-strength {
    display: none; /* Initially hide the password strength indicator */
    position: absolute;
    top: 50%; /* Center vertically */
    left: 80%; /* Center horizontally */
    transform: translate(-50%, -50%); /* Center the box */
    background-color: #fff; /* White background */
    border: 1px solid #ccc; /* Add border */
    border-radius: 5px; /* Add border radius */
    padding: 10px; /* Add padding */
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1); /* Add shadow */
}
        #password-strength li {
            text-align: center;
            color: #ccc;
            padding: 5px;
        }
        #password-strength li.active {
            color: green;
        }

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
      <h1>Sign Up</h1>
      <form action="../../php_users/register/login.php" method="post">
        
        <hr>
        
        <label id="icon" for="name"><i class="fas fa-envelope"></i></label>
        <input type="text" name="email"  placeholder="Email" required/>

        <label id="icon" for="name"><i class="fas fa-user"></i></label>
        <input type="text" name="user_name"  placeholder="User Name" required/>

        <label id="icon" for="name"><i class="fas fa-unlock-alt"></i></label>
        <input type="password" name="password" id="password" placeholder="Password" required oninput="showPasswordStrength()"/>
        <input type="checkbox" onclick="myFunction()"> Show Password <br>
        <label id="icon" for="name"><i class="fas fa-unlock-alt"></i></label>
        <input type="password" name="re-type_password" id="password2" placeholder="Confirm Password" required/>
        <input type="checkbox" onclick="myFunction2()"> Show Password

        <hr>
        <div class="gender">
          <input type="radio" value="men" id="male" name="gender" checked/>
          <label for="male" class="radio">Male</label>
          <input type="radio" value="girl" id="female" name="gender" />
          <label for="female" class="radio">Female</label>
        </div>
        <hr>
        <div class="btn-block">
          <!-- <p>Don't have an account? <a href="sign_up.html.php">Sign Up</a></p> -->
          <button type="submit" onclick="validateForm()" name="sign_up">Sign Up</button>
        </div>
        <hr>
        Already have an account? <a href="register.html.php">Sign In</a>
      </form>
    </div>
    <ul id="password-strength">
        <li class="criteria" id="length">At least 8 characters</li>
        <li class="criteria" id="uppercase">At least one uppercase letter</li>
        <li class="criteria" id="lowercase">At least one lowercase letter</li>
        <li class="criteria" id="number">At least one number</li>
        <li class="criteria" id="special">At least one special character</li>
    </ul>
    <script>
      function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function myFunction2() {
  var x = document.getElementById("password2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function validateForm() {
  var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("password2").value;
            var passwordStrength = checkPasswordStrength(password);
            
            if (password !== confirmPassword) {
                alert("Password and confirm password do not match");
                event.preventDefault(); // Prevent form submission
                return false;
            }
            
            if (!passwordStrength) {
                alert("Password is not strong enough");
                event.preventDefault(); // Prevent form submission
                return false;
            }
            
            return true; // Allow form submission
        }

    function checkPasswordStrength(password) {
            var strength = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /\d/.test(password),
                special: /[^A-Za-z0-9]/.test(password)
            };

            var criteriaElements = document.querySelectorAll('.criteria');

            criteriaElements.forEach(function(criteriaElement, index) {
                if (strength[criteriaElement.id]) {
                    criteriaElement.classList.add('active');
                } else {
                    criteriaElement.classList.remove('active');
                }
            });

            // Check if all criteria are met
            return Object.values(strength).every(Boolean);
        }

        // Function to show password strength indicator
        function showPasswordStrength() {
            var passwordStrength = document.getElementById("password-strength");
            var password = document.getElementById("password").value;
            if (password.length > 0) {
                passwordStrength.style.display = "block";
                checkPasswordStrength(password);
            } else {
                passwordStrength.style.display = "none";
            }
        }
    </script>
  </body>
</html>
