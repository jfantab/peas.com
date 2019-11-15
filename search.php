<?php
######################## CONNECT SEARCH BUTTON TO USER_INPUT ########################

$user_input = "Indian";
$number_of_queries = 2;

echo $user_input;
echo "<br><br>";

include 'clean_string.php';

echo $user_input;
echo "<br><br>";

include 'get_by_recipe.php'; #gets from api and puts in database


#$recipes = ['759603','584373'];
for($i = 0; $i <= sizeof($recipes)-1; $i++){
	echo $recipes[$i];
	echo "<br><b>";
}
$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="peas";
	
$db = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

for($i = 0; $i <= sizeof($recipes)-1; $i++){
	$sql = "SELECT recipe_id, recipe_name, recipe_likes, readyinMinutes, recipe_image, recipe_instructions from recipe where recipe_id = $recipes[$i]";
	$result = mysqli_query($db, $sql);
	$followingdata = $result->fetch_assoc();
	echo $followingdata["recipe_id"];
	echo "<br><br>";
	echo $followingdata["recipe_name"];
	echo "<br><br>";
	echo $followingdata["recipe_likes"];
	echo "<br><br>";
	echo $followingdata["readyinMinutes"];
	echo "<br><br>";
	echo $followingdata["recipe_image"];
	echo "<br><br>";
	echo $followingdata["recipe_instructions"];
	echo "<br><br>";
}





$db->close();

?>
