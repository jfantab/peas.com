<?php
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

