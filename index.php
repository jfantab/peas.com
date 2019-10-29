<head>
<link rel="shortcut icon" href="recipe.ico" type="image/x-icon" /> 
</head>
<title>peas</title>
<?php
	session_start();

	#code MYSQL gives you to connect to PHP
	$host="127.0.0.1";
	$port=3306;
	$socket="";
	$user="root";
	$password="";
	$dbname="peas";

	$db = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());
?>

<!DOCTYPE html>
<html>
<head>
	<title>peas</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
	<h1>Search Page</h1>
</div>
<form method="post" action="register.php">
	<table>
		<tr>
			<td>Username:</td>
			<td><input type="text" name="username" class="textInput"></td>
		<tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password" class="textInput"></td>
		<tr>

		<tr>
			<td></td>
			<td><input type="submit" name="register_btn" value="Register"></td>
		<tr>
	</table>
</form>
<div><h4>Welcome <?php echo $_SESSION['username']; ?></h4></div>
<div><a href="logout.php">Log out</a></div>
</body>
</html>







