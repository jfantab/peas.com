<?php
    function populateRecipes(&$recipes, &$recipeIDs, $db) {
        for ($i = 0; $i < count($recipeIDs); $i++) {
            $sql = "SELECT recipe_id, recipe_name, recipe_likes, readyInMinutes, recipe_serving, recipe_image, recipe_instructions, recipe_vegan, recipe_dairy, recipe_gluten, recipe_fodmap FROM Recipe WHERE recipe_id = $recipeIDs[$i]";
            $makeQuery = mysqli_query($db, $sql);
            $currentRecipe = mysqli_fetch_assoc($makeQuery);
            //echo $currentRecipe;
            $sql = "SELECT ingredient_amt from recipe_ingredients where recipe_id = $recipeIDs[$i]";
            $ingredient_list = mysqli_query($db, $sql);
            $currentIngredients = array();
            while ($row = $ingredient_list->fetch_array()) {
                $currentIngredients[] = $row;
            }
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
                "gluten_free"=>$currentRecipe['recipe_gluten'],
                "ingredients"=>$currentIngredients
            );
            array_push($recipes, $tempArray);
            $recipes = array_values($recipes);
        }
    }
    function getByRecipe(&$recipeIDs, $user_input, $db) {
        include 'clean_string_recipe.php';
        ######################## CONNECT SEARCH BUTTON TO USER_INPUT ########################
        /*Right now this is just a constant variable but we will connect this to a submit button*/
        #$user_input = "grandma's%20cookies";
        ######################## CONSTRUCT API HTTP REQUEST #################################
        /*This is the URL that will be in the cURL request function*/
        $baseURL = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/search?number=";
        $bool_instructions = "&offset=0&instructionsRequired=true&query=";
        $number_of_queries = 5;
        $baseURL .= $number_of_queries;
        $baseURL .= $bool_instructions;
        $baseURL .= $user_input;
        ######################## GET RECIPE BY HTTP REQUEST #################################
        #Using a test JSON file for now
        $curl = curl_init();
        curl_setopt_array($curl, array(
        	CURLOPT_URL => $baseURL,
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_FOLLOWLOCATION => true,
        	CURLOPT_ENCODING => "",
        	CURLOPT_MAXREDIRS => 10,
        	CURLOPT_TIMEOUT => 30,
        	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        	CURLOPT_CUSTOMREQUEST => "GET",
        	CURLOPT_HTTPHEADER => array(
        		"x-rapidapi-host: spoonacular-recipe-food-nutrition-v1.p.rapidapi.com",
        		"x-rapidapi-key: ae97828bcdmsh8763975686b1d9cp19500fjsnd39c542737a9"
        	),
        ));
        $response = curl_exec($curl);
        #echo $response;
        #echo "<br><br>";
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
        	echo "cURL Error #:" . $err;
        }
        #$json_array = json_decode($response, true);
        #$json_string = file_get_contents('recipe_results.json');
        $json_array = json_decode($response, true);
        ######################## STORE RECIPE IN PHP ARRAY ##################################
        for ($x = 0; $x <= sizeof($json_array['results'])-1; $x++)
            $recipeIDs[$x] = $json_array['results'][$x]['id'];
        ######################## ITERATE OVER RECIPE RESULTS ################################
        for($i = 0; $i <= sizeof($recipeIDs)-1; $i++){
        ######################## CONSTRUCT API HTTP REQUEST #################################
        	$baseURL = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/";
        	$get_recipe_information = "/information";
        	$baseURL .= $recipeIDs[$i];
        	$baseURL .= $get_recipe_information;
        ######################## GET RECIPE INFORMATION BY HTTP REQUEST #####################
        #Using test JSON file for now
        	$curl = curl_init();
        	curl_setopt_array($curl, array(
        		CURLOPT_URL => $baseURL,
        		CURLOPT_RETURNTRANSFER => true,
        		CURLOPT_FOLLOWLOCATION => true,
        		CURLOPT_ENCODING => "",
        		CURLOPT_MAXREDIRS => 10,
        		CURLOPT_TIMEOUT => 30,
        		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        		CURLOPT_CUSTOMREQUEST => "GET",
        		CURLOPT_HTTPHEADER => array(
        			"x-rapidapi-host: spoonacular-recipe-food-nutrition-v1.p.rapidapi.com",
        			"x-rapidapi-key: ae97828bcdmsh8763975686b1d9cp19500fjsnd39c542737a9"
        		),
        	));
        	$response = curl_exec($curl);
        	#echo $response;
        	#echo "<br><br>";
        	$err = curl_error($curl);
        	curl_close($curl);
        	if ($err) {
        		echo "cURL Error #:" . $err;
        	}
        	$json_array = json_decode($response, true);
        ######################## DECCODE AND EXTRACT FROM JSON ARRAY ########################
        	#Your variables will be constant if you are using a test JSON file
        	#$json_string = file_get_contents('recipe_information.json');
        	#$json_array = json_decode($json_string, true);
        	$recipe_id = $json_array['id'];
        	$recipe_name = $json_array['title'];
        	$recipe_likes = $json_array['aggregateLikes'];
        	$readyInMinutes = $json_array['readyInMinutes'];
        	$recipe_serving = $json_array['servings'];
        	$recipe_image = $json_array['image'];
        	$recipe_instruct = $json_array['instructions'];

        	$recipe_instruct = mysqli_real_escape_string($db, $recipe_instruct);

        	$recipe_vegan = $json_array['vegan'];
        	$recipe_vegan = $recipe_vegan == '' ? '0' : '1';
        	$recipe_dairy = $json_array['dairyFree'];
        	$recipe_dairy = $recipe_dairy == '' ? '0' : '1';
        	$recipe_gluten = $json_array['glutenFree'];
        	$recipe_gluten = $recipe_gluten == '' ? '0' : '1';
        	$recipe_fodmap = $json_array['lowFodmap'];
        	$recipe_fodmap = $recipe_fodmap == '' ? '0' : '1';

        	$recipe_ingredients_ids = [];
        	$recipe_ingredients_names = [];
        	$recipe_ingredients_amount = [];
        	for ($x = 0; $x <= sizeof($json_array['extendedIngredients'])-1; $x++) {
        		$recipe_ingredients_ids[$x] = $json_array['extendedIngredients'][$x]['id'];
        		$recipe_ingredients_names[$x] = $json_array['extendedIngredients'][$x]['name'];
        		$recipe_ingredients_amount[$x] = $json_array['extendedIngredients'][$x]['originalString'];
        	}
        ######################## UPDATE RECIPE ############################
        	$sql = "INSERT INTO Recipe(recipe_id, recipe_name, readyInMinutes, recipe_serving, recipe_image, recipe_instructions, recipe_vegan, recipe_dairy, recipe_gluten, recipe_fodmap)
        		VALUES
        			('$recipe_id', '$recipe_name', '$readyInMinutes', '$recipe_serving', '$recipe_image', '$recipe_instruct', '$recipe_vegan', '$recipe_dairy', '$recipe_gluten', '$recipe_fodmap')";
        		mysqli_query($db, $sql);
        	    
        ######################## UPDATE INGREDIENT ########################
        	for ($x = 0; $x <= sizeof($json_array['extendedIngredients'])-1; $x++) {
        		$sql = "INSERT INTO Ingredient(ingredient_id, ingredient_name)
        			VALUES
        				('$recipe_ingredients_ids[$x]','$recipe_ingredients_names[$x]')";
        		mysqli_query($db, $sql);
        	}
        ######################## UPDATE RECIPE_INGREDIENT #################
        	for ($x = 0; $x <= sizeof($json_array['extendedIngredients'])-1; $x++) {
        		$sql = "INSERT INTO Recipe_Ingredients(recipe_id, ingredient_id, ingredient_amt)
        			VALUES
        				('$recipe_id','$recipe_ingredients_ids[$x]','$recipe_ingredients_amount[$x]')";
        		mysqli_query($db, $sql);
        	}
		sleep(0.3);
	}
        }
    
    function getByIngredient(&$recipeIDs, $user_input, $db) {
        ######################## CONNECT SEARCH BUTTON TO USER_INPUT ########################
        /*You must have no spaces in your string!*/
        include 'clean_string_ingredients.php';
        /*Right now this is just a constant variable but we will connect this to a submit button*/
        ######################## CONSTRUCT API HTTP REQUEST #################################
        /*Use user_input for a custom search string and search_string for a user specific cache search
        /*This is the URL that will be in the cURL request function*/
        $baseURL = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/findByIngredients?number=";
        $number_of_queries = 5;
        $other_instructions = "&ranking=1&ignorePantry=true&ingredients=";
        $baseURL .= $number_of_queries;
        $baseURL .= $other_instructions;
        $baseURL .= $user_input; #or $search_string when logged in.
        #apples%2Cflour%2Csugar
        #echo "<br><br>";
        #echo $baseURL;
        #echo "<br><br>";
        ######################## GET RECIPE BY INGREDIENT BY HTTP REQUEST ########################
        $curl = curl_init();
        curl_setopt_array($curl, array(
        	CURLOPT_URL => $baseURL,
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_FOLLOWLOCATION => true,
        	CURLOPT_ENCODING => "",
        	CURLOPT_MAXREDIRS => 10,
        	CURLOPT_TIMEOUT => 30,
        	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        	CURLOPT_CUSTOMREQUEST => "GET",
        	CURLOPT_HTTPHEADER => array(
        		"x-rapidapi-host: spoonacular-recipe-food-nutrition-v1.p.rapidapi.com",
        		"x-rapidapi-key: ae97828bcdmsh8763975686b1d9cp19500fjsnd39c542737a9"
        	),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
        	echo "cURL Error #:" . $err;
        }
        $json_array = json_decode($response, true);
        ######################## STORE RECIPE IN PHP ARRAY ##################################
        for ($x = 0; $x <= sizeof($json_array)-1; $x++)
            $recipeIDs[$x] = $json_array[$x]['id'];

        ######################## ITERATE OVER RECIPE RESULTS ################################
        for($i = 0; $i <= sizeof($recipeIDs)-1; $i++){
        ######################## CONSTRUCT API HTTP REQUEST #################################
            $baseURL = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/";
            $get_recipe_information = "/information";
            $baseURL .= $recipeIDs[$i];
            $baseURL .= $get_recipe_information;
        ######################## GET RECIPE INFORMATION BY HTTP REQUEST #####################
            #Using test JSON file for now
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $baseURL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: spoonacular-recipe-food-nutrition-v1.p.rapidapi.com",
                    "x-rapidapi-key: ae97828bcdmsh8763975686b1d9cp19500fjsnd39c542737a9"
                )
            ));
            $response = curl_exec($curl);
            #echo $response;
            #echo "<br><br>";
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            }
            $json_array = json_decode($response, true);
            ######################## DECCODE AND EXTRACT FROM JSON ARRAY ########################
            #Your variables will be constant if you are using a test JSON file
            #$json_string = file_get_contents('recipe_information.json');
            #$json_array = json_decode($json_string, true);

            $recipe_id = $json_array['id'];
            $recipe_name = $json_array['title'];
            $recipe_likes = $json_array['aggregateLikes'];
            $readyInMinutes = $json_array['readyInMinutes'];
            $recipe_serving = $json_array['servings'];
            $recipe_image = $json_array['image'];
            $recipe_instruct = $json_array['instructions'];

        	$recipe_instruct = mysqli_real_escape_string($db, $recipe_instruct);

        	$recipe_vegan = $json_array['vegan'];
        	$recipe_vegan = $recipe_vegan == '' ? '0' : '1';
        	$recipe_dairy = $json_array['dairyFree'];
        	$recipe_dairy = $recipe_dairy == '' ? '0' : '1';
        	$recipe_gluten = $json_array['glutenFree'];
        	$recipe_gluten = $recipe_gluten == '' ? '0' : '1';
        	$recipe_fodmap = $json_array['lowFodmap'];
        	$recipe_fodmap = $recipe_fodmap == '' ? '0' : '1';

            $recipe_ingredients_ids = [];
            $recipe_ingredients_names = [];
            $recipe_ingredients_amount = [];
            for ($x = 0; $x <= sizeof($json_array['extendedIngredients'])-1; $x++) {
                $recipe_ingredients_ids[$x] = $json_array['extendedIngredients'][$x]['id'];
                $recipe_ingredients_names[$x] = $json_array['extendedIngredients'][$x]['name'];
                $recipe_ingredients_amount[$x] = $json_array['extendedIngredients'][$x]['originalString'];
            }

            ######################## UPDATE RECIPE ############################
            $sql = "INSERT INTO Recipe(recipe_id, recipe_name, readyInMinutes, recipe_serving, recipe_image, recipe_instructions, recipe_vegan, recipe_dairy, recipe_gluten, recipe_fodmap)
                VALUES
                    ('$recipe_id', '$recipe_name', '$readyInMinutes', '$recipe_serving', '$recipe_image', '$recipe_instruct', '$recipe_vegan', '$recipe_dairy', '$recipe_gluten', '$recipe_fodmap')";
            mysqli_query($db, $sql);

            ######################## UPDATE INGREDIENT ########################
            for ($x = 0; $x <= sizeof($json_array['extendedIngredients'])-1; $x++) {
                $sql = "INSERT INTO Ingredient(ingredient_id, ingredient_name)
                    VALUES
                        ('$recipe_ingredients_ids[$x]','$recipe_ingredients_names[$x]')";
                mysqli_query($db, $sql);
            }
            ######################## UPDATE RECIPE_INGREDIENT #################
            for ($x = 0; $x <= sizeof($json_array['extendedIngredients'])-1; $x++) {
                $sql = "INSERT INTO Recipe_Ingredients(recipe_id, ingredient_id, ingredient_amt)
                    VALUES
                        ('$recipe_id','$recipe_ingredients_ids[$x]','$recipe_ingredients_amount[$x]')";
                mysqli_query($db, $sql);
            }
        }
    }


    function resetArrays($recipes) {
        for ($i = 0; $i < count($recipes); $i++) {
            for ($j = 0; $j < count($recipes[$i]); $j++) {
                unset($recipes[$i][$j]);
            }
            $recipes[$i] = array_values($recipes[$i]);
        }
    }
    function removeRecipe($recipes, $recipeIDs, $recipe) {
        for ($i = 0; $i < count($recipes); $i++) {
            if ($recipes[$i] == $recipe) {
                unset($recipes[$i]);
                $recipes = array_values($recipes);
                unset($recipeIDs[$i]);
                $recipeIDs = array_values($recipeIDs);
            }
        }
    }
    function filterResults($recipes, $recipeIDs, $filter) {
        for ($i = 0; $i < count($recipes); $i++) {
            if ($recipes[$i][$filter] == FALSE) {
                removeRecipe($recipes, $recipeIDs, $recipes[$i]);
            }
        }
    }
    function compareByCookTime($recipeOne, $recipeTwo) {
        return ($recipeOne['prep_time'] > $recipeTwo['prep_time']);
    }
    function compareByServings($recipeOne, $recipeTwo) {
        return ($recipeOne['servings'] > $recipeTwo['servings']);
    }
    function sortByCookTime($recipes, $recipeIDs, $sortBy) {
        usort($recipes, compareByCookTime);
        for ($i = 0; $i < count($recipeIDs); $i++) {
            $recipeIDs[$i] = $recipes[$i]['id'];
        }
    }
    function sortByServings($recipes, $recipeIDs, $sortBy) {
        usort($recipes, compareByServings);
        for ($i = 0; $i < count($recipeIDs); $i++) {
            $recipeIDs[$i] = $recipes[$i]['id'];
        }
    }
    function addToMyRecipes($recipes) {
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
                        <p class="list-group-item-text"><b>Cook time: </b><?php echo $recipes[$x]['prep_time']; ?> minutes</p>
                        <div class="collapse" id="recipe<?php echo $x; ?>">
                            <b>Ingredients: </b> <br>
                                <?php
                                    for ($y = 0; $y < count($recipes[$x]['ingredients']); $y++) {
                                        $currentIngredient = "";
                                        for ($z = 0; $z < count($recipes[$x]['ingredients'][$y]) - 1; $z++) {
                                            $currentIngredient .= $recipes[$x]['ingredients'][$y][$z];
                                        }
                                        echo $currentIngredient;
                                        echo "<br>";
                                    }
                                ?>
                            <br> <p><b>Instructions: </b><?php echo $recipes[$x]['instructions']; ?></p>
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
