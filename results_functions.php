<?php
    function updateArrays($recipes) {
        for ($i = 0; $i < count($recipes); $i++) {
            for ($j = 0; $j < count($recipes[$i]); $j++) {
                if ($j == 0) {

                } elseif ($j == 1) {

                } elseif ($j == 2) {

                } elseif ($j == 3) {

                } elseif ($j == 4) {

                } elseif ($j == 5) {

                } elseif ($j == 6) {

                } elseif ($j == 7) {

                } elseif ($j == 8) {

                } elseif ($j == 9) {

                } elseif ($j == 10) {

                }
            }
        }
    }

    function testArrays($recipes) {
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
?>