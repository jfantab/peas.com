<?php
    session_start();
    $namePlaceholder = "";
    if(!isset($_SESSION['username'])){
        $namePlaceholder = "";
    }
    else{
        $namePlaceholder = $_SESSION['username'] . "!";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="bootstrap.css" rel="stylesheet">
    <link href="home.css" rel="stylesheet">
    <link rel="shortcut icon" href="recipe.ico" type="image/x-icon" />
    <script src="https://kit.fontawesome.com/a126e12bdc.js" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container-fluid main">
        <div class="row jumbotron jumbotron-fluid welcome">
            <div class="container-fluid">
                <div class="col"></div>
                <div class="col text-center headings">
                    <h1 class="display-2">Welcome <strong><?php echo $namePlaceholder; ?></strong></h1>
                    <br>
                    <h2>What would you like to cook today?</h2>
                </div>
                <div class="col text-center">
                    <button type="button" class="btn btn-light" id="scrollButton">
                        <a href="#forms"><i class="fas fa-angle-down fa-7x"></i></a>
                    </button>
                </div>
            </div>
        </div>
        <div class="search" id="forms">
            <div class="col" id="form1">
                <form name="searchBar" class="formSearch" action="get_by_ingredient.php">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for recipes by ingredients" name="ingredient_input" id="ingredients">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary"><a href="results.php">Submit</a></button>
                        </span>
                    </div>
                    <small>Please enter ingredients separated by commas.</small>
                </form>
            </div>
            <hr>
            <div class="col" id="form2">
                <form name="searchBar" class="formSearch" action="get_by_recipe.php">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for recipes by name" name="recipe_input" id="recipes">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary"><a href="results.php">Submit</a></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
