<?php
######################## CONNECT SEARCH BUTTON TO USER_INPUT ########################
# THIS FILE ONLY EDITS $user_input

#gets rid of white space on left and right side
$isolated = trim($user_input);

#ensure that only lowercase, uppercase, and spaces are allowed in string
$ready = preg_replace("/[^A-Za-z,]/","", $isolated);

#convert spaces to URL friendly '%20'
$user_input = str_replace(',', '%252C', $ready);

?>
