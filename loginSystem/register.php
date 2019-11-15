<!-- This is the old code
<head>
<link rel="shortcut icon" href="recipe.ico" type="image/x-icon" /> 
</head>


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
			header("location: ../main.html");
		}else{
			$_SESSION['message'] = "The two passwords do not match";
		}
	}

$db->close();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Register to Peas</title>
	<link rel="stylesheet" type="text/css" href="register.css">
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
the new code is below/ this vvvv should be before doctype with ?
<php include('server.php') >
-->

<!DOCTYPE html>
<head>
    <title>Register/Login to Peas</title>
    <link href="register.css" rel="stylesheet">
     <link href="bootstrap.css" rel="stylesheet">
</head>
<body>
     <div class="navbar navbar-expand-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="../main.html" id="logo"><h3>Peas.com</h3></a>
            </div>
        </div>
    <div class="header">
        <h2>Register</h2>
    </div>

    <form method="post" action="../main.html">
    <?php include('errors.php'); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
             <label>Password</label>
             <input type="password" name="password_1">
        </div>
        <div class="input-group">
             <label>Confirm</label>
             <input type="password" name="password_2">
        </div>
        <div class="input-group">
             <button type="submit" name="register" class="btn">Register</button>
        </div>
    </form>
    <p>Already a member? <a href="login.php">Sign In</a></p>
</body>
</html>