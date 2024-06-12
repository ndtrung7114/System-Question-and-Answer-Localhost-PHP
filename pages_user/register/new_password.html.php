<!DOCTYPE html>
<html>
  <head>
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="register.css"> -->
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
        body {
    font-family: 'Roboto', sans-serif; /* Use Roboto font */
    background-image: url('../../images/background.jpg'); /* Set the background image path */
      background-size: cover; /* Cover the entire viewport */
      background-position: center; /* Center the background image *//* Set a background color */
    margin: 0;
    padding: 10%;
}

.main-block {
    position: relative;
    margin: 0 auto;
    background-color: rgba(255, 255, 255, 0.8); /* Add a semi-transparent white background for better readability */
      
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
    width: 400px;
    padding: 20px;
    
   
    box-sizing: border-box;
}

h1 {
    text-align: center;
}

form {
    margin-top: 20px;
}

label#icon {
    margin-right: 10px;
}

input[type="password"],
input[type="text"] {
    width: calc(100% - 30px);
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="checkbox"] {
    margin-left: 10px;
}

.btn-block {
    text-align: center;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #eee;
}
        
    </style>
  </head>
  <body>
    <div class="main-block">
      <h1>Reset Password</h1>
      <form  action="../../php_users/register/new_password.php" method="post" >
        
        <label id="icon" for="name"><i class="fas fa-unlock-alt"></i></label>
        <input type="password" id="newPassword" name="new_password"  placeholder="New password" required oninput="showPasswordStrength()">
        <input type="checkbox" onclick="myFunction()">Show Password <br>


        <label id="icon" for="name"><i class="fas fa-unlock-alt"></i></label>
        <input type="password" id="confirmPassword" name="confirm_password"  placeholder="Confirm new password" required/>
        <input type="checkbox" onclick="myFunction2()">Show Password
        <hr>
        
        <div class="btn-block">
          <!-- <p>Don't have an account? <a href="sign_up.html.php">Sign Up</a></p> -->
          <button type="submit" onclick="validateForm()" name="save_change">Save Change</button>
        </div>
        <hr>
        Already have an account? <a href="../../pages_user/register/register.html.php">Sign In</a>
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
  var x = document.getElementById("newPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function myFunction2() {
  var x = document.getElementById("confirmPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function validateForm() {
  var password = document.getElementById("newPassword").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
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
            var password = document.getElementById("newPassword").value;
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
