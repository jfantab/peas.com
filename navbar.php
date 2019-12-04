<?php
    //session_start();
    $buttonText = "";
    $link = "";
     if (!isset($_SESSION['username'])) {
        $buttonText = "Login/Register";
        $link = "loginSystem/login.php";
        $user = False;
      }
     else{
        $buttonText = "Log Out";
         $link = "loginSystem/logout.php";
         $user = True;
     }
?>
<div class="navbar navbar-expand-sm">
    <div class="container-fluid">
    <a class="navbar-brand" href="main.php" id="logo"><h3>Peas.com</h3></a>
    <ul class="navbar-nav" id="links">
        <?php if($user) { ?>
            <li class="nav-item item">
                <a href="user.php" class="text-dark btn"><h3>User</h3></a>
            </li>
        <?php } ?>
        <li class="nav-item item">
            <a href=<?php echo $link; ?> class="text-dark btn"><h3><?php echo $buttonText; ?></h3></a>
        </li>
    </ul>
    </div>
</div>
