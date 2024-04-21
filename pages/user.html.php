<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <title>Document</title>
</head>
<body>
<div class="w3-container w3-card w3-white w3-round w3-margin">
    <div class="row mt-4">
        <form action="search_user.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="search_user" id="search" placeholder="Filer by username..." aria-describedby="basic-addon2" autocomplete="off">
          <button class="btn btn-outline-secondary" type="submit" name="submit" id="basic-addon22">Search</button>
        </div>
        </form> 
                    
        <div class="card list-group" id="show-list"></div>  
    </div>

    </form>
            <form action="search_user.php" method="post">
            <input type="submit" class="w3-button w3-theme" name="reputation" value="Reputation">
    </form> 
</div> 

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="script.js"></script>
<script>
// Call the searchFunction with appropriate parameters
searchFunction("#search", "complete_search_user.php");
</script>


    

    

</body>
</html>




    

    
