<!DOCTYPE html>
<html lang="en">

<?php
$user_id = '999';
$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="root";
$dbname="peas";

 $db = new mysqli($host, $user, $password, $dbname, $port, $socket) or die ('Could not connect to the database server' . mysqli_connect_error());


?>

<head>
    <title>Profile</title>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <link href="bootstrap.css" rel="stylesheet">
    <link href="user.css" rel="stylesheet">
</head>
<body>
    <?php include_once('navbar.php'); ?>

    <div class="row jumbotron jumbotron-fluid user">
        <div class="container">
            <h1 class="user-name"> John Doe!</h1>
        </div>
    </div>

    <div class="container-fluid" id="header-row">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <h2 style="text-align:center"> My Pantry </h2>
            </div>
            <div class="col-md-7">
                <h2 style="text-align:center"> My Recipes </h2>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <div class="container-fluid" id="search-row">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3 input-group">
                    <input id="search" class="form-control" type="text" name="item" placeholder="Search...">
                    <span class="input-group-btn">
                          <button class="search" type="submit">
                             <img src="search.png">
                          </button>
                    </span>
                 

            </div>

            <div class="col-md-7 input-group">
                <input type="text" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                          <button class="search" type="submit">
                              <img src="search.png">
                          </button>
                     </span>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>

            <div style: "height:1000px; class="col-md-3" id="ingredients">

                <ul class="list-group" style="height:500px; overflow:scroll">

                   <?php
                        $query = "SELECT  ingredient_name FROM ingredient_cache, ingredient WHERE ingredient.ingredient_id = ingredient_cache.ingredient_id and user_id = $user_id";
                        $result = mysqli_query($db, $query);
                        $search_query = "SELECT ingredient_name FROM ingredient_cache WHERE ingredient_name = $item";
                        $search_result = mysqli_query($db, $search_query);

                   while($row = mysqli_fetch_array($search_result){
                        <li style="text-align: left; padding:10px; margin-left:-20px; margin-right: -15px" class="list-group-item"><?php echo $row['ingredient_name']; ?></li>
                   } 

                   if(mysqli_num_rows($result) > 0) {
                       while($row = mysqli_fetch_array($result)){	?>
                            <li style="text-align: left; padding:10px; margin-left:-20px; margin-right: -15px" class="list-group-item"><?php echo $row['ingredient_name']; ?></li>
                        <?php }

                        mysqli_free_result($result);

                    } else{
                        echo "<li>"."Pantry is Empty!"."</li>";
                    }

                    ?>
                </ul>

            </div>
            <div class="col-md-7">
                <div class="panel list-group" id="results-list" style="height:500px; overflow:scroll">
                    <a href="#recipeOne" class="btn list-group-item list-group-item-action" data-toggle="collapse" data-parent="#results-list">
                        <h4 class="list-group-item-heading">Recipe 1</h4>
                        <p class="list-group-item-text">Cook time: X</p>
                        <div class="collapse" id="recipeOne">
                            Ingredients: Item 1, Item 2, Item 3, Item 4
                        </div>
                    </a>
                </div>
            <div class="col-md-1"> </div>
            </div>
        </div>




            <!-- Scripts-->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
