
    $(document).ready(function(){
        $("#search_ingredient").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#pantry li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(document).ready(function(){
        $("#search_recipe").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#recipe_list a").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
