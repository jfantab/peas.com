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
                        $query = "SELECT  ingredient_name FROM Ingredient";
                        $result = mysqli_query($db, $query);


                   if(mysqli_num_rows($result) > 0) {
                       while($row = mysqli_fetch_array($result)){	?>
                            <li style="text-align: left; padding:10px" class="list-group-item" id="item">

                                <form action="" method="post">

                                    <?php echo $row['ingredient_name'];?>
                                    <input type="hidden" name="ingredient_name" value= "<?php echo $row['ingredient_name']; ?>">
                                    <button type="submit" name="delete" style="float:right; border:none;">&times</button>
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
                $recipes = array(
                    $testRecipe = array(
                         "id"=>282,
                         "image"=>'https://spoonacular.com/recipeImages/282-556x370.jpg',
                         "servings"=>4,
                         "likes"=>0,
                         "prep_time"=>45,
                         "name"=>'Roasted Salmon With Spicy Cauliflower',
                         "instructions"=>'Preheat oven to 450 degrees. Gather garlic, anchovies (if using), and red-pepper flakes into a pile. Using a chefs knife, coarsely chop; season generously with salt. Using flat side of knife blade, mash mixture into a paste.',
                         "dairy_free"=>TRUE,
                         "vegan"=>FALSE,
                         "low_fodmap"=>FALSE,
                         "gluten_free"=>TRUE
                     )
                );
                include 'results_functions.php';
                ?>

            <div class="col-md-7">
                <div id="recipe_list" class="panel list-group" style="max-height:900px; overflow-y:auto; overflow-x: hidden">
                    <?php
                        for ($x=0; $x<1; $x++) {
                    ?>
                    <a href="#recipe<?php echo $x; ?>" class="btn list-group-item list-group-item-action" data-toggle="collapse"  data-parent="#results-list">
                        <div class="row">
                        <img src=<?php echo $recipes[$x]['image']; ?> height=150 width=150 style="padding-left:10px; padding-right:10px; padding-bottom:10px">
                        <span>
                        <h4 class="list-group-item-heading"><b><?php echo $recipes[$x]['name']; ?></b></h4>
                        <br>



                        <p class="list-group-item-text">Cook time: </b><?php echo $recipes[$x]['prep_time']; ?> minutes</p>
                        <p class="list-group-item-text"><b>Likes: </b><?php echo $recipes[$x]['likes']; ?></span></p>
                        <p class="list-group-item-text">
                            <?php
                                if ($recipes[$x]['dairy_free']) {
                                    ?><b>Dairy Free   </b><?php
                                }
                                if ($recipes[$x]['vegan']) {
                                    ?><b>Vegan   </b><?php
                                }
                                if ($recipes[$x]['low_fodmap']) {
                                    ?><b>Low FODMAP   </b><?php
                                }
                                if ($recipes[$x]['gluten_free']) {
                                    ?><b>Gluten Free   </b><?php
                                }
                            ?>
                        </p>
                        </div>
                        </span>

                        <div class="collapse" id="recipe<?php echo $x; ?>">
                            <b>Instructions: </b><?php echo $recipes[$x]['instructions']; ?>
                            <div class="d-flex justify-content-end">
                                <form action="user_functions.php" method="post">
                                    <input type="hidden" name="recipe_name" value= "<?php $recipes[$x]['name'] ?>">
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
