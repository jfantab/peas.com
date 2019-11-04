<?php

#COST OF "API POINTS" OF RUNNING THIS FILE IS $number_of_queries + 1 to factor for getting recipe result list

######################## CONNECT TO MYSQL DATABASE #######################################

$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="peas";
	
$db = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

######################## CONNECT SEARCH BUTTON TO USER_INPUT ########################
/*You must have no spaces in your string!*/
$user_input = "eggs,buttermilk,vanilla";
session_start();
/*Right now this is just a constant variable but we will connect this to a submit button*/

######################## CONSTRUCT API HTTP REQUEST #################################
/*Use user_input for a custom search string and search_string for a user specific cache search
/*This is the URL that will be in the cURL request function*/
$baseURL = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/findByIngredients?number=";
$number_of_queries = 2;
$other_instructions = "&ranking=1&ignorePantry=true&ingredients=";

$baseURL .= $number_of_queries;
$baseURL .= $other_instructions;
$baseURL .= $user_input; #or $search_string when logged in.
#apples%2Cflour%2Csugar
#echo "<br><br>";
#echo $baseURL;
#echo "<br><br>";
	
######################## OPTIONAL USER_CACHE #############################################

/*HERE WE NEED TO FIND A WAY TO CONNECT TO THE USER_ID OF WHO IS LOGGED IN*/
/*
$sql = "SELECT  ingredient_name FROM ingredient_cache, ingredient where ingredient.ingredient_id = ingredient_cache.ingredient_id and user_id = '995'";

$result = $db->query($sql);


$ingredients_list = "";
if($result = mysqli_query($db, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
        	$ingredients_list .= $row['ingredient_name'];
		$ingredients_list .= ",";
        }

	$search_string = substr($ingredients_list, 0, -1);
        echo $search_string;
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
}
*/

/* The important variable here is the $search_string ^*/


######################## GET RECIPE BY INGREDIENT BY HTTP REQUEST ########################

#We are using a test JSON file for now

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


for ($x = 0; $x <= sizeof($json_array)-1; $x++)
$recipes[$x] = $json_array[$x]['id'];


for($i = 0; $i <= sizeof($recipes)-1; $i++){
	#echo $recipes[$i];
	#echo "<br><br>";

	$baseURL = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/";
	$get_recipe_information = "/information";

	$baseURL .= $recipes[$i];

	$baseURL .= $get_recipe_information;

######################## GET RECIPE INFORMATION BY HTTP REQUEST #####################


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
	
	$recipe_id = $json_array['id'];
	#echo $recipe_id;
	#echo "<br><br>";
	
	$recipe_name = $json_array['title'];
	#echo $recipe_name;
	#echo "<br><br>";
	
	$recipe_likes = $json_array['aggregateLikes'];
	#echo $recipe_likes;
	#echo "<br><br>";
	
	$readyInMinutes = $json_array['readyInMinutes'];
	#echo $readyInMinutes;
	#echo "<br><br>";
	
	$recipe_image = $json_array['image'];
	#echo $recipe_image;
	#echo "<br><br>";
	
	$recipe_instruct = $json_array['instructions'];
	#echo $recipe_instruct;
	#echo "<br><br>";
	
	$recipe_ingredients_ids = [];
	$recipe_ingredients_names = [];
	$recipe_ingredients_amount = [];
	for ($x = 0; $x <= sizeof($json_array['extendedIngredients'])-1; $x++) {
		$recipe_ingredients_ids[$x] = $json_array['extendedIngredients'][$x]['id'];
		$recipe_ingredients_names[$x] = $json_array['extendedIngredients'][$x]['name'];
		$recipe_ingredients_amount[$x] = $json_array['extendedIngredients'][$x]['originalString'];
	}

	
	for ($x = 0; $x <= sizeof($json_array['extendedIngredients'])-1; $x++) {
		#echo $recipe_ingredients_ids[$x];
		#echo "<br><br>";
		#echo $recipe_ingredients_names[$x];
		#echo "<br><br>";
		#echo $recipe_ingredients_amount[$x];
		#echo "<br><br>";
	}

######################## UPDATE RECIPE ############################	
	$sql = "INSERT INTO Recipe(recipe_id, recipe_name, readyInMinutes, recipe_image, recipe_instructions)
		VALUES
			('$recipe_id', '$recipe_name', '$readyInMinutes', '$recipe_image', '$recipe_instruct')";
	
	mysqli_query($db, $sql);
	echo "Recipe Inserted";
	echo "<br><br>";
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

	sleep(1);
}
$db->close();
?>
