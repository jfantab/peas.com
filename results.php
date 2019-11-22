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
                    <a href="results.html" type="button" class="btn btn-primary">Submit</a>
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

        <!-- Results list--->
        <div class="col"></div>
        <div class="panel list-group" id="results-list">
            <?php
            for ($x = 0; $x < 5; $x++) {
            ?>
                <a href="#recipe<?php echo $x; ?>" class="btn list-group-item list-group-item-action" data-toggle="collapse" data-parent="#results-list">
                    <h4 class="list-group-item-heading">Recipe <?php echo $x; ?></h4>
                    <p class="list-group-item-text">Cook time: X</p>
                    <div class="collapse" id="recipe<?php echo $x; ?>">
                        Ingredients: Item 1, Item 2, Item 3, Item 4
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="button">Add to My Recipes</button>
                        </div>
                    </div>
                </a>
            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>