<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/questions.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Document</title>
  <style>
    
  </style>
</head>
<body>

<div class="w3-container w3-card w3-white w3-round w3-margin">
  <br>
    <div class="dropdown">
    <button onclick="toggleDropdown()" style="border-radius: 10px;" class="w3-button w3-theme-d2 w3-margin-bottom" ><i class="fa-solid fa-filter"></i> Filter</button>
    <div id="filterDropdown" class="dropdown-content" style="display: none;">
    <div class="w3-container w3-card w3-white w3-round w3-margin">
      <form action="../../php_users/read/search_question.php" method='post'>
        <div class='Sorted by'>
          <h3>Sorted by</h3>
          <input type="radio" value="highest vote" id="radioOne" name="role">
          <label for="radioOne" class="radio">Highest vote</label> <br>
          <input type="radio" value="highest view" id="radioTwo" name="role" >
          <label for="radioTwo" class="radio">Highest view</label><br>
          <input type="radio" value="most answer" id="radioThree" name="role" >
          <label for="radioThree" class="radio">Most answer</label>
        </div>

        <div class='module'>
          <h3>With module</h3>
          <select name="module_id" id="">
          <option value="none">None</option>
            <?php
            foreach ($modules as $module) {
            ?>
                <option value="<?= $module['module_id'] ?>"><?= $module['module_name'] ?></option>
            <?php } ?>
        </select><br><br>
        </div>

        <!-- Move the "Apply filter" button inside the form -->
        <input type="submit" style="border-radius: 10px;" name='filter' class="w3-button w3-theme-d2 w3-margin-bottom" value="Apply filter">
      </form>
    </div>
    </div>
  </div>
    </div>

<div class="w3-container w3-card w3-white w3-round w3-margin">
<h3><?= $searchCount?> Result</h3>
</div>
<?php
    session_start();
    list($user_id_logging, $userDatalogging) = getUserData($connect);
    
    // include "../connect.php";
    foreach ($searchResults as $result): 
      $user_id = $result['user_id'];
      $userData = get_user_data($user_id, $connect); 
      $total_comments = count_total_comment($connect, 'comment', $result['question_id']);
      $vote_count = count_votes_for_question($connect, $result['question_id'])?>
      
      <div class="w3-container w3-card w3-white w3-round w3-margin">
          <br>
          <!-- Display user avatar -->
          <img src="../../images/<?=$userData['avatar']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
          <!-- Display time -->
          <span class="w3-right w3-opacity"><?php echo $result['date']; ?></span><br>
          <span class="w3-right w3-opacity"><?php echo $result['time']; ?></span>
          <!-- Display user name -->
          <h4><p style="color: #1D65CE;"><?= $userData['user_name'] ?></p></h4>
          <br>
          <hr class="w3-clear">
          <!-- Display question content -->
          <form action="../../php_users/read/view_question.php" method="post">
            <input type="hidden" name="question_id" value="<?= $result['question_id']; ?>">
            <input type="hidden" name='user_id_logging' value=<?= $user_id_logging ?>>
            <h3><b><input type="submit" style="color: #1D65CE; background: none; border: none; padding: 0; font-family: Times New Roman; cursor: pointer; text-decoration: none;" value="<?= $result['title']; ?>"></b></h3> <br>
            
          </form>
          <h5><p style="font-family: Times New Roman"><?php echo $result['content']; ?></p></h5><br>

          <form action="../../php_users/read/search_module.php" method='post'>
            <input type="hidden" name='module_id' value="<?= $result['module_id'] ?> ">
            <h6> <input style="font-family: Times New Roman; color: #1D65CE; background-color: #BAD0F0; border: 0; border-radius: 10px;" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Click to see details"  type="submit" name='search_from_question'  value="<?= $result['module_name'] ?>"> </h6><br>
          </form>
          
        
          <!-- Like, Edit, and Delete buttons -->
          
          
          

          <!-- Like and Comment buttons -->
          <button type="button" style="border-radius: 10px;" class="w3-button w3-theme-d1 w3-margin-bottom" title="Score of <?= $vote_count ?> "><i class="fa fa-thumbs-up"></i> </i> Vote (<?= $vote_count ?>)</button> 
          <button type="button" style="border-radius: 10px;" class="w3-button w3-theme-d2 w3-margin-bottom" title="<?= $result['view'] ?> views"><i class="fa fa-eye"></i> View (<?= $result['view'] ?>)</button>
          
          <button type="submit" style="border-radius: 10px;" class="w3-button w3-theme-d2 w3-margin-bottom" title='<?= $total_comments ?> ' ><i class="fa fa-comment"></i> Answer (<?= $total_comments ?>) </button>
          
          
         
      </div>
    <?php endforeach; ?>

    <script>
    function toggleDropdown() {
      var dropdown = document.getElementById("filterDropdown");
      if (dropdown.style.display === "none" || dropdown.style.display === "") {
        dropdown.style.display = "block";
      } else {
        dropdown.style.display = "none";
      }
    }
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  </script>
</body>
</html>

