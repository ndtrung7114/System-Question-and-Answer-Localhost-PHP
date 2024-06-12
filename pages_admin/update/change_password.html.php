<!DOCTYPE html>

<html>

  <head>
    <title>Change Password</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Style for the password strength indicator */
        #password-strength {
    display: none; /* Initially hide the password strength indicator */
    position: absolute;
    top: 50%; /* Center vertically */
    left: 130%; /* Center horizontally */
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
    </style>
  </head>
  <?php
    session_start();
    list($user_id_logging, $userDatalogging) = getUserData($connect);?>
  <body>
    
  

  <div class="w3-container w3-card w3-white w3-round w3-margin">
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h1 class="text-center">Reset Password</h1><br>
                    <ul id="password-strength">
                        <li class="criteria" id="length">At least 8 characters</li>
                        <li class="criteria" id="uppercase">At least one uppercase letter</li>
                        <li class="criteria" id="lowercase">At least one lowercase letter</li>
                        <li class="criteria" id="number">At least one number</li>
                        <li class="criteria" id="special">At least one special character</li>
                    </ul>
                    <form action="../../php_admin/update/change_password.php" method="post">
                        <!-- Existing password -->
                        <div class="form-group">
                            <label for="typeoldPassword"><i class="fas fa-unlock-alt"></i> Existing Password</label>
                            <input type="password" class="form-control" id="typeoldPassword" name="type_old_password" placeholder="Existing password">
                        </div>
                        <!-- New password -->
                        <div class="form-group">
                            <label for="newPassword"><i class="fas fa-unlock-alt"></i> New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="new_password" placeholder="New password" required oninput="showPasswordStrength()">
                            
                            <input type="checkbox" onclick="myFunction1()"> Show Password
                        </div>
                        <!-- Confirm new password -->
                        <div class="form-group">
                            <label for="confirmPassword"><i class="fas fa-unlock-alt"></i> Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Confirm new password" required>
                            <input type="checkbox" onclick="myFunction2()"> Show Password
                        </div>
                        <hr>
                        <!-- Save Change button -->
                        <div class="text-center">
                        <input type="hidden" name='old_password' value='<?= $user_infor['password'] ?>'>
                        <input type="hidden" name='user_id' value='<?= $user_infor['user_id'] ?>'>
                            <button type="submit" class="btn btn-primary" onclick="validateForm()" name="change">Save Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
    
    
    

    <script>
      function myFunction1() {
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
