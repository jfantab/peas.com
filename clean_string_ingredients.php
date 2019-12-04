<?php
######################## CONNECT SEARCH BUTTON TO USER_INPUT ########################
# THIS FILE ONLY EDITS $user_input
$user_input = 'app%les, fl%our, sug%ar ';
echo $user_input;
echo "<br><br>";
#gets rid of white space on left and right side
$isolated = trim($user_input);
echo $isolated;
echo "<br><br>";
#ensure that only lowercase, uppercase, and spaces are allowed in string
$ready = preg_replace("/[^A-Za-z,]/","", $isolated);
echo $ready;
echo "<br><br>";
#convert spaces to URL friendly '%20'
$user_input = str_replace(',', '%252C', $ready);

echo $user_input;
echo "<br><br>";

?>
