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
                    <input id="search_ingredient" class="form-control" type="text" name="item" placeholder="Search...">
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



            <?php

                include 'user_functions.php';
                ?>

            <div class="col-md-7">
                <div id="recipe_list" class="panel list-group" style="max-height:900px; overflow-y:auto; overflow-x: hidden">
                <?php
                    for($i = 0; $i <= sizeof($recipes)-1; $i++){
                    	$sql = "SELECT recipe_id, recipe_name, recipe_likes, readyinMinutes, recipe_image, recipe_instructions from recipe where recipe_id = $recipes[$i]";
                    	$result = mysqli_query($db, $sql);
                    	$followingdata = $result->fetch_assoc(); ?>
                    <a href="#recipe<?php echo $x; ?>" class="btn list-group-item list-group-item-action" data-toggle="collapse"  data-parent="#results-list">
                        <div class="row">
                        <img src=<?php echo $followingdata[$x]['image']; ?> height=150 width=150 style="padding-left:10px; padding-right:10px; padding-bottom:10px">
                        <span>
                        <h4 class="list-group-item-heading"><b><?php echo $followingdata[$x]['name']; ?></b></h4>
                        <br>



                        <p class="list-group-item-text">Cook time: </b><?php echo $followingdata[$x]['prep_time']; ?> minutes</p>
                        <p class="list-group-item-text"><b>Likes: </b><?php echo $followingdata[$x]['likes']; ?></span></p>
                        <p class="list-group-item-text">
                            <?php
                                if ($followingdata[$x]['dairy_free']) {
                                    ?><b>Dairy Free   </b><?php
                                }
                                if ($followingdata[$x]['vegan']) {
                                    ?><b>Vegan   </b><?php
                                }
                                if ($followingdata[$x]['low_fodmap']) {
                                    ?><b>Low FODMAP   </b><?php
                                }
                                if ($followingdata[$x]['gluten_free']) {
                                    ?><b>Gluten Free   </b><?php
                                }
                            ?>
                        </p>
                        </div>
                        </span>

                        <div class="collapse" id="recipe<?php echo $x; ?>">
                            <b>Instructions: </b><?php echo $followingdata[$x]['instructions']; ?>
                            <div class="d-flex justify-content-end">
                                <form action="user_functions.php" method="post">
                                    <input type="hidden" name="recipe_name" value= "<?php $followingdata[$x]['name'] ?>">
                                    <button class="btn btn-primary" name="remove_recipe" type="button">Remove</button>

                                </form>
                            </div>
                        </div>
                    </a>
                    <?php }
                    $db->close();?>
                </div>
            <div class="col-md-1"> </div>
            </div>
        </div>



</body>
</html>
