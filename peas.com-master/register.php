<!--
- Page used for registration and logging in
-->


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
	if(isset($_POST['login_btn']))
	{
		mysqli_select_db($con, 'peas');

		$name = $_POST['user'];
		$pass = $_POST['password'];

		$s = " select * from user where username = '$name' && password = '$pass'";

		$result = mysqli_query($con, $s);
		$num = mysqli_num_rows($result);

if($num == 1)
{
  $_SESSION['username'] = $name;
  header('location:index.php');
}else{
  header('location:register.php');
}
	}

$db->close();

?>

<!DOCTYPE html>
<html>
<head>
	<title>peas</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container">
		<div class="login-box">
	  <div class="row">
			<div class="col-md-6 login-left">
        <form action="register.php" method="post">
				<h2>Login Here</h2>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="user" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button type="submit" name="login_btn" class="btn btn-primary">Login</button>
        </form>
			</div>
			<div class="col-md-6 login-right">
			<form method="post" action="register.php">
				<h2>Register Here</h2>
				<div class="form-group">
				<label>Username</label>
					<input type="text" name="user" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required>
						</div>
					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password" name="password2" class="form-control" required>
					</div>
						<button type="submit" name="register_btn" class="btn btn-primary">Register</button>
			</form>
		</div>
		</div>
		</div>
</div>
</body>
</html>
