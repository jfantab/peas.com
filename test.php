<?php

$user_id = '999';

$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="peas";
	
$db = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

$sql = "SELECT  ingredient_name FROM ingredient_cache, ingredient where ingredient.ingredient_id = ingredient_cache.ingredient_id and user_id = $user_id";

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
echo "<br><b>";

$sql = "SELECT  recipe_id FROM recipe_cache where user_id = $user_id";

$result = $db->query($sql);

$recipes = [];
$counter = 0;
if($result = mysqli_query($db, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
		$recipes[$counter] = $row['recipe_id'];
		$counter += 1;	
        }
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
echo "<br><b>";
}

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
/*
INSERT INTO User(user_id, username, password)
VALUES 
	(999, 'John Lu', 'password'),
    (998, 'Mayah Vandertuig', 'password'),
    (997, 'Will Kolada', 'password'),
    (996, 'Hayden Lewis', 'password'),
    (995, 'Parker Johnson', 'password');

INSERT INTO Ingredient_Cache(ingredient_id, user_id)
VALUES
    (1001,999),
    (1012,999),
    (1123,999),
    (2004,999),
    (2010,999);


    
INSERT INTO Recipe_Cache(recipe_id, user_id)
VALUES
	(62526,999),
    (167399,999),
    (198293,999),
    (202303,999),
    (296012,999);
*/
?>




