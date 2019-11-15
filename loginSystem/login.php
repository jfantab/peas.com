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
        <h2>Login</h2>
    </div>
    <!-- action used to say login.php, now it just redirects you to homepage -->
    <form method="post" action="../main.html">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>
        <div class="input-group">
             <label>Password</label>
             <input type="password" name="password_1">
        </div>
        <div class="input-group">
             <button type="submit" name="login" class="btn">Login</button>
        </div>
    </form>
    <p>Not a member? <a href="register.php">Sign Up</a></p>
</body>
</html>