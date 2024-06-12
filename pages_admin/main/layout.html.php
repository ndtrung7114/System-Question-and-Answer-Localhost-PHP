<?php 
        
        $user_id_logging = $_SESSION['user_id'];
        $userDatalogging = get_user_data($user_id_logging, $connect);
 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Main System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/layout.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    
    <style>
    html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
    .w3-col.m3 {
  position: fixed;
  top: 80px; /* Adjust as needed based on your header height */
  left: 20px;
  height: 100%;
  overflow-y: auto;
}

.w3-col.m7 {
  margin-left: 25%; /* Adjust based on the width of your left column */
  margin-right: 25%; /* Adjust based on the width of your right column */
}

.w3-col.m2 {
  position: fixed;
  top: 80px; /* Adjust as needed based on your header height */
  right: 20px;
  height: 100%;
  overflow-y: auto;
} ul {
  list-style: none;
  padding: 0;
}

li {
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 10px;
  padding: 10px;
}

li:last-child {
  margin-bottom: 0;
}
    /* Style for the left and right columns */
    
    
    </style>
    
  </head>
<body class="w3-theme-l5">





<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-orange w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-orange"><i class="fa fa-home w3-margin-right"></i>Logo</a>
  
   

  <form action="../read/profile_user.php" method="post">
    <button type="submit" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="<?=$userDatalogging['name']?>">
        <img src="../../images/<?=$userDatalogging['avatar']?>" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
    </button>
    <input type="hidden" name="user_id" value="<?=$user_id_logging?>">
</form>

  


 </div>
</div>


<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">My Profile</h4>
         
         <p class="w3-center"><img src="../../images/<?=$userDatalogging['avatar']?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> <?=$userDatalogging['job']?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> <?=$userDatalogging['country']?></p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?=$userDatalogging['birth']?></p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Groups</button>
          <div id="Demo1" class="w3-hide w3-container">
            <p>Some text..</p>
          </div>
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Events</button>
          <div id="Demo2" class="w3-hide w3-container">
            <p>Some other text..</p>
          </div>
          <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Photos</button>
          <div id="Demo3" class="w3-hide w3-container">
            <div class="w3-row-padding">
         <br>
         <?php $images = select_all_images($connect,$userDatalogging['user_id'] );
         foreach ($images as $image) { ?>
         <div class="w3-half">
             <img src="../../images/<?= $image['image'] ?>" style="width:100%" class="w3-margin-bottom">
           </div>

         <?php } ?>
          
         </div>
          </div>
        </div>      
      </div>
      <br>
      
      
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
    
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              
              <form action="../../php_admin/read/search_question.php" method="post">
                <input type="text" style="border-radius: 10px;" class="form-control" name="search" placeholder="Type your question..."><br>
                <button class="w3-button w3-theme" style="border-radius: 10px;"  type="submit"><i class="fa fa-search"></i> Search</button>
                <button id="askQuestionBtn" style="border-radius: 10px;" type="button" class="w3-button w3-theme"><i class="fa fa-pencil"></i> Ask Question</button> 
              </form>
              
            </div>
          </div>
        </div>
      </div>
      
      <?= $output ?>
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
      
      <ul>
        <li><a href="../main/index.php">Home</a></li>
        <li><a href="../read/questions.php">Question</a></li>
        <li><a href="../read/notify.php">Notification</a></li>
        <li><a href="../read/user.php">User</a></li>
        
        <li><a href="../read/save.php">Saves</a></li>
        <li><a href="../read/module.php">Module</a></li>
        
        <li><a href="../read/logout.php">Sign Out</a></li>
      </ul>
      
      </div>
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Made with <a href="https://www.w3schools.com/spaces" target="_blank">W3Schools Spaces</a></p>
</footer>
 
<script>
  var links = document.querySelectorAll('a');

links.forEach(function(link) {
  link.addEventListener('click', function() {
    links.forEach(function(link) {
      link.classList.remove('active');
    });
    this.classList.add('active');
  });
});

// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}


  // Get reference to the "Ask Question" button
var askQuestionBtn = document.getElementById('askQuestionBtn');

// Add click event listener to the button
askQuestionBtn.addEventListener('click', function() {
    // Redirect to the "Ask Question" page
    location = '/coursework/pages_admin/create/post_question.html.php';
  });

</script>

</body>
</html> 
