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
    <link href="home.css" rel="stylesheet" type="text/css">
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
            <div class="col" id="formOne">
                <form name="searchBar" class="formSearch" action="get_by_ingredient.php" method="post">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for recipes by ingredients" id="ingredients">
                        <span class="input-group-btn">
                            <input type="button" class="btn btn-primary" value="ingredient_input"><a href="results.php">Submit</a></input>
                        </span>
                    </div>
                    <small>Please enter ingredients separated by commas.</small>
                </form>
            </div>
            <hr>
            <div class="col" id="formTwo">
                <form name="searchBar" class="formSearch" action="get_by_recipe.php" method="post">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for recipes by name" id="recipes">
                        <span class="input-group-btn">
                            <input type="button" class="btn btn-primary" value="recipe_input"><a href="results.php">Submit</a></input>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
