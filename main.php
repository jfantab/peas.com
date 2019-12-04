<?php
    session_start();
    $namePlaceholder = "";
    if(!isset($_SESSION['username'])){
        $namePlaceholder = "";
    }
    else{
        //$namePlaceholder = " Hayden";
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
            </div>
        </div>
        <div class="search" id="forms">
            <div class="jumbotron jumbotron-fluid" id="formOne">
                <div id="forms"></div>
                <div class="container-fluid">
                    <form name="searchBar" class="formSearch" action="results.php">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search for recipes by ingredients" name="ingredient_input" id="ingredients">
                                <?php
                                    if(isset($_REQUEST["ingredient_input"])){
                                        $ingredient_input = $_REQUEST["ingredient_input"];
                                    }
                                ?>
                                <input type="hidden" value="<?php echo $ingredient_input ?>">
                                <span><input type="submit"></span>
                         </div>
                         <small>Please enter ingredients separated by commas.</small>
                    </form>
                </div>
            </div>
            <div class="jumbotron jumbotron-fluid" id="formTwo">
                <div class="container-fluid">
                    <form name="searchBar" class="formSearch" action="results.php" method=‘POST’>
                        <div class="input-group">
                            <input class="form-control" type="search" placeholder="Search for recipes by name" name="input-search" id="input-search" value="">
                            <?php
                                if(isset($_REQUEST["input-search"])){
                                    $recipe_input = $_REQUEST["input-search"];
                                }
                            ?>
                            <input type="hidden" value="<?php echo $recipe_input ?>">
                            <span><input type="submit"></span>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
