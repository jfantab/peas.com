<?php

$user_id = '999';
$host="localhost";
$port=3306;
$socket="";
$user="root";
$password="root";
$dbname="peas";
 $db = new mysqli($host, $user, $password, $dbname, $port, $socket) or die ('Could not connect to the database server' . mysqli_connect_error());
?>
