<?php
    function populateRecipes(&$recipes, &$recipeIDs, $db) {
        for ($i = 0; $i < count($recipeIDs); $i++) {
            $sql = "SELECT recipe_id, recipe_name, recipe_likes, readyinMinutes, recipe_serving, recipe_image, recipe_instructions, recipe_vegan, recipe_dairy, recipe_gluten, recipe_fodmap from test_recipe where recipe_id = $recipeIDs[$i]";
            $makeQuery = mysqli_query($db, $sql);
            $currentRecipe = $makeQuery->fetch_assoc();

            $tempArray = array(
                "id"=>$currentRecipe['recipe_id'],
                "image"=>$currentRecipe['recipe_image'],
                "servings"=>$currentRecipe['recipe_serving'],
                "likes"=>$currentRecipe['recipe_likes'],
                "prep_time"=>$currentRecipe['readyinMinutes'],
                "name"=>$currentRecipe['recipe_name'],
                "instructions"=>$currentRecipe['recipe_instructions'],
                "dairy_free"=>$currentRecipe['recipe_dairy'],
                "vegan"=>$currentRecipe['recipe_vegan'],
                "low_fodmap"=>$currentRecipe['recipe_fodmap'],
                "gluten_free"=>$currentRecipe['recipe_gluten']
            );
            array_push($recipes, $tempArray);
            $recipes = array_values($recipes);
        }
    }

    function testArray($recipes) {
        array_push($recipes, $testRecipe = array(
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
        ));
    }

    function resetArrays($recipes) {
        for ($i = 0; $i < count($recipes); $i++) {
            for ($j = 0; $j < count($recipes[$i]); $j++) {
                unset($recipes[$i][$j]);
            }
            $recipes[$i] = array_values($recipes[$i]);
        }
    }

    function removeRecipe($recipes, $recipe) {
        for ($i = 0; $i < count($recipes); $i++) {
            if ($recipes[$i] == $recipe) {
                unset($recipes[$i]);
                $recipes = array_values($recipes);
            }
        }
    }

    function filterResults($recipes, $filter) {

    }

    function sortResults($recipes, $sortBy) {

    }

    function displayResults($recipes, $db) {
        if (count($recipes) <= 0) {
            ?>
                <div class="col text-center headings">
                    <h3>Sorry, there were no recipes found! Try changing your search inputs or remove some filters.</h3>
                </div>
            <?php
        } else {
            ?>
            <div class="col"></div>
            <div class="panel list-group" id="results-list">
                <?php
                for ($x = 0; $x < count($recipes); $x++) {
                ?>
                    <a href="#recipe<?php echo $x; ?>" class="btn list-group-item list-group-item-action" data-toggle="collapse" data-parent="#results-list">
                        <h4 class="list-group-item-heading"><b><?php echo $recipes[$x]['name']; ?></b></h4>
                        <img src=<?php echo $recipes[$x]['image']; ?> height:20% width=20% style="padding-left:10px; padding-right:10px; padding-bottom:10px">
                        <p class="list-group-item-text"><b>Cook time: </b><?php echo $recipes[$x]['prep_time']; ?> minutes
                            <span align="right"><b>Likes: </b><?php echo $recipes[$x]['likes']; ?></span>
                        </p>
                        <div class="collapse" id="recipe<?php echo $x; ?>">
                            <b>Ingredients: </b>
                                <?php
                                    $sql = "SELECT ingredient_amt from recipe_ingredients where recipe_id = $recipes[$x]['id']";
                                    $ingredient_list = mysqli_query($db, $sql);
                                    while($ingredient_data = mysqli_fetch_array($ingredient_list)) {
                                         echo $ingredient_data['ingredient_amt'];
                                         echo "<br>";
                                    }
                                ?>
                            <p><b>Instructions: </b><?php echo $recipes[$x]['instructions']; ?></p>
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
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary" type="button">Add to My Recipes</button>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div><?php
        }
    }
?>