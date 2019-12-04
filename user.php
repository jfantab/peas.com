<!DOCTYPE html>
<html lang="en">

<!-- Scripts-->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script type="text/javascript" src="search.js"></script>



<?php
require_once("config.php");
session_start();
    $namePlaceholder = " ";
    if(!isset($_SESSION['username']))
    {
        $namePlaceholder = "";
    }
    else{
        $namePlaceholder = $_SESSION['username'];
    }
?>

<head>
    <title>Profile</title>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <link href="bootstrap.css" rel="stylesheet">
    <link href="user.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>


    <div class="row jumbotron jumbotron-fluid user">
        <div class="container">
            <h1 class="user-name"><?php echo $namePlaceholder; ?></h1>
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
                    <input id="search" class="form-control" type="text" name="item" placeholder="Add...">
                                        <span class="input-group-btn">
                                              <button class="search" type="submit">
                                                 +
                                              </button>
                                        </span>
            </div>
            <div class="col-md-7 input-group">
                <input id="search_recipe" type="text" class="form-control" placeholder="Search...">
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>

            <div style: "height:1000px; class="col-md-3" >
                <ul class="list-group" id="pantry" style="max-height:900px; overflow-y:auto; overflow-x: hidden">
                   <?php
                        $query = "SELECT  ingredient_name FROM ingredient_cache, ingredient where ingredient.ingredient_id = ingredient_cache.ingredient_id and user_id = $user_id";
                        $result = mysqli_query($db, $query);
                   if(mysqli_num_rows($result) > 0) {
                       while($row = mysqli_fetch_array($result)){	?>
                            <li style="text-align: left; padding:10px" class="list-group-item" id="item">
                                <form action="" method="post">
                                    <?php echo $row['ingredient_name'];?>
                                    <input type="hidden" name="ingredient_name" value= "<?php echo $row['ingredient_name']; ?>">
                                    <a style="float:right" href="delete.php?id=<?php echo $row['ingredient_name']; ?>">&times</a>
                                </form>
                            </li>
                        <?php }
                        mysqli_free_result($result);
                    } else{
                        echo "<li>"."Pantry is Empty!"."</li>";
                    }
                    ?>
                </ul>
            </div>
           <?php include 'user_functions.php';?>
            <div class="col-md-7">
                <div id="recipe_list" class="panel list-group" style="max-height:900px; overflow-y:auto; overflow-x: hidden">
                <?php
                    for($x = 0; $x <= sizeof($recipes)-1; $x++){
                    	$sql = "SELECT recipe_id, recipe_name, recipe_likes, readyInMinutes, recipe_image, recipe_instructions, recipe_dairy, recipe_gluten, recipe_fodmap, recipe_vegan from recipe where recipe_id = $recipes[$x]";
                    	$recipe_list = mysqli_query($db, $sql);
                    	while($recipe_data = mysqli_fetch_array($recipe_list)) { ?>
                    <a href="#recipe<?php echo $x; ?>" class="btn list-group-item list-group-item-action" data-toggle="collapse"  data-parent="#results-list">
                        <div class="row">
                        <img src=<?php echo $recipe_data['recipe_image']; ?> height:20% width=20% style="padding-left:10px; padding-right:10px; padding-bottom:10px">
                        <span>
                        <h4 class="list-group-item-heading"><b><?php echo $recipe_data['recipe_name']; ?></b></h4>
                        <br>
                        <p class="list-group-item-text">Cook time: </b><?php echo $recipe_data['readyInMinutes']; ?> minutes</p>
                        <p class="list-group-item-text">
                            <?php
                                if ($recipe_data['recipe_dairy']) {
                                    ?><b>Dairy Free   </b><?php
                                }
                                if ($recipe_data['recipe_vegan']) {
                                    ?><b>Vegan   </b><?php
                                }
                                if ($recipe_data['recipe_fodmap']) {
                                    ?><b>Low FODMAP   </b><?php
                                }
                                if ($recipe_data['recipe_gluten']) {
                                    ?><b>Gluten Free   </b><?php
                                }
                            ?>
                        </p>
                        </div>
                        </span>
                        <div class="collapse" id="recipe<?php echo $x; ?>">
                            <b>Ingredients: </b> <br>
                            <?php
                            $query = "SELECT ingredient_amt from recipe_ingredients where recipe_id = $recipes[$x]";
                            $ingredient_list = mysqli_query($db, $query);
                            while($ingredient_data = mysqli_fetch_array($ingredient_list)) {
                                 echo $ingredient_data['ingredient_amt'];
                                 echo "<br>";
                                 }
                                 ?>
                            <br> <b>Instructions: </b> <br>
                            <?php echo $recipe_data['recipe_instructions']; ?>
                            <div class="d-flex justify-content-end">
                                <form action="user_functions.php" method="post">
                                    <input type="hidden" name="recipe_name" value= "<?php $recipe_data['recipe_name'] ?>">
                                    <button class="btn btn-primary" name="remove_recipe" onclick="remove_recipe()" type="button">Remove</button>
                                </form>
                            </div>
                        </div>
                    </a>
                    <?php } }
                    $db->close();?>
                </div>
            <div class="col-md-1"> </div>
            </div>
        </div>
</body>
</html>
