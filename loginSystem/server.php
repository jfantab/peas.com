<?php
    session_start();

    $username = "";
    $email = "";
    $errors = array();

    //connect to db
    $db = mysqli_connect('localhost', 'root', 'root', 'peas');

    //if the registeration button is clicked
    if(isset($_POST['register'])){
        $username = mysql_real_escape_string($_POST['username']);
        $email = mysql_real_escape_string($_POST['email']);
        $password_1 = mysql_real_escape_string($_POST['password_1']);
        $password_2 = mysql_real_escape_string($_POST['password_2']);

        //validate form input
        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($email)){
            array_push($errors, "Email is required");
        }
        if(empty($password_1)){
            array_push($errors, "Password is required");
        }
        if($password_1 != $password_2){
            array_push($errors, "Passwords do not match");
        }
        //if no errors save user to db
        if(count($errors == 0)
        {
            $password = md5($password_1); //password encryption
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password' )";
            mysqli_query($db, $sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: ../main.html')
         }

    }
?>