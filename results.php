<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="bootstrap.css" rel="stylesheet">
    <link href="results.css" rel="stylesheet">

    <!-- Scripts-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <!-- Create database connection-->
    <?php
        $host="localhost";
        $port=3306;
        $socket="";
        $user="root";
        $password="Criticalhit1!";
        $dbname="peas";

        $db = new mysqli($host, $user, $password, $dbname, $port, $socket)
        	or die ('Could not connect to the database server' . mysqli_connect_error());
    ?>

    <!-- Functions-->
    <?php
    $recipes = array();
    include 'results_functions.php';
    $recipeIDs = array();
    if(isset($_REQUEST["input-search"]))
        {$recipe_input = $_REQUEST["input-search"];}
    echo $recipe_input;
    if(isset($_REQUEST["ingredient_input"]))
        {$ingredient_input = $_REQUEST["ingredient_input"];}
    echo $ingredient_input;
    echo $recipe_input;
    getByRecipe($recipeIDs, $recipe_input, $db);
    // 282, 341, 392, 431, 474, 518, 541, 860, 760118
    populateRecipes($recipes, $recipeIDs, $db);
    ?>

    <title>Search Results</title>
</head>
<body>
    <!-- Navigation bar-->
    <?php include 'navbar.php'; ?>

    <!-- Search again-->
    <div class="container-fluid main results">
        <div class="col"></div>
        <form name="searchBar" class="formSearch">
            <div class="input-group mx-auto" style="width: 1000px">
                <input class="form-control" type="text" placeholder="Search again" value="" id="ingredients">
                <span class="input-group-btn">
                    <a href="results.php" type="button" class="btn btn-primary">Submit</a>
                </span>
            </div>
        </form>

        <!-- Filtering-->
        <div class="col text-center headings">
            <h3>Filter By:</h3>
            <br>
            <div class="filters d-flex justify-content-center">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dietDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dietary Restriction
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dietDropDown">
                        <form>
                            <div class="checkbox dropdown-item">
                                <label><input type="checkbox"> Vegan</label>
                            </div>
                            <div class="checkbox dropdown-item">
                                <label><input type="checkbox"> Gluten Free</label>
                            </div>
                            <div class="checkbox dropdown-item">
                                <label><input type="checkbox"> Dairy Free</label>
                            </div>
                            <div class="checkbox dropdown-item">
                                <label><input type="checkbox"> Low FODMAP</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <!-- Sorting -->
        <div class="col text-center headings">
            <h3>Sort By:</h3>
            <br>
            <div class="sorting d-flex justify-content-around">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <input type="radio" name="options" id="option1" autocomplete="off"> Cook Time
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="options" id="option2" autocomplete="off"> Likes
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="options" id="option3" autocomplete="off"> Total Calories
                    </label>
                </div>
            </div>
            <br>
        </div>

        <!-- Results list -->
        <?php
            displayResults($recipes, $db);
            $db->close();
        ?>
    </div>
</body>
</html>
