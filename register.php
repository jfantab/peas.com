<head>
<link rel="shortcut icon" href="recipe.ico" type="image/x-icon" /> 
</head>

<style>
body {
	background-image: url("fruit_wallpaper.jpg");
}

</style>
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

	
	if (isset($_POST['register_btn'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$password2 = mysqli_real_escape_string($db,$_POST['password2']);

		if ($password == $password2) {
			//create user
			//hash password
			$password = md5($password);
			$sql = "INSERT INTO User(username, password)
				VALUES('$username', '$password')";
			mysqli_query($db, $sql);
			$_SESSION['message'] = "You are now logged in";
			$_SESSION['username'] = $username;
			header("location: home.php");
		}else{
			$_SESSION['message'] = "The two passwords do not match";
		}
	}

$db->close();

?>

<!DOCTYPE html>
<html>
<head>
	<title>peas</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
	<h1>Register to peas</h1>
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
			<td>Confirm Password:</td>
			<td><input type="password" name="password2" class="textInput"></td>
		<tr>
		<tr>
			<td></td>
			<td><input type="submit" name="register_btn" value="Register"></td>
		<tr>
	</table>
</form>

</body>
</html>



