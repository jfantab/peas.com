<?php

#Here is the code that RapidAPI gives you to connect to the spoonacular API through PHP and cURL
#I am using a text_file to connect to the API as to not make constant requests to the API

/*
$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/findByIngredients?number=5&ranking=1&ignorePantry=false&ingredients=apples%2Cflour%2Csugar",
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
} else {
	echo $response;
}
*/

#Parsing through decoded JSON
/*Search by Recipe should be done in two parts, one call to GET the list of recipe id's and
another to call GET the recipe information per recipe id. This includes its ingredients*/
######################## SEARCH BY RECIPE #############################
$json_string = file_get_contents('recipe_results.json');
$json_array = json_decode($json_string, true);

for ($x = 0; $x <= sizeof($json_array['results'])-1; $x++)
$recipe_id[$x] = $json_array['results'][$x]['id'];

#EXAMPLE PRINT
for ($x = 0; $x <= sizeof($json_array['results'])-1; $x++) {
	echo $recipe_id[$x];
	echo "<br><br>";
}

######################## GET RECIPE INFORMATION ########################
$json_string = file_get_contents('recipe_information.json');
$json_array = json_decode($json_string, true);

$recipe_image = $json_array['image'];
$recipe_name = $json_array['title'];
$readyInMinutes = $json_array['readyInMinutes'];
$recipe_instruct = $json_array['instructions'];

/*Creates list of ingredients and ingredient names and puts them in two arrays*/
$recipe_ingredients = [];
$recipe_ingredients_names = [];
$recipe_ingredients_amount = [];
for ($x = 0; $x <= sizeof($json_array['extendedIngredients'])-1; $x++) {
	$recipe_ingredients[$x] = $json_array['extendedIngredients'][$x]['id'];
	$recipe_ingredients_names[$x] = $json_array['extendedIngredients'][$x]['name'];
	$recipe_ingredients_amount[$x] = $json_array['extendedIngredients'][$x]['amount'];;
}

#EXAMPLE PRINT
for ($x = 0; $x <= sizeof($json_array['extendedIngredients'])-1; $x++) {
echo $recipe_ingredients[$x];
echo "<br><br>";
echo $recipe_ingredients_names[$x];
echo "<br><br>";
echo $recipe_ingredients_amount[$x];
echo "<br><br>";
}
echo "<br><br>";
echo $recipe_image;
echo "<br><br>";
echo $recipe_name;
echo "<br><br>";
echo $readyInMinutes;
echo "<br><br>";
echo $recipe_instruct;

######################## SEARCH BY INGREDIENT ########################
$json_string = file_get_contents('recipe_by_ingredients.json');
$json_array = json_decode($json_string, true);

$recipe_names = [];
for ($x = 0; $x <= sizeof($json_array)-1; $x++) {
	$recipe_ids[$x] = $json_array[$x]['id'];
}
	
#EXAMPLE PRINT
for ($x = 0; $x <= sizeof($json_array)-1; $x++) {
echo $recipe_ids[$x];
echo "<br><br>";
}

