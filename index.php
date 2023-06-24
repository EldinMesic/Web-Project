<?php
session_start();

require_once "database/db_manager.php";



if(isset($_SESSION['user'])){
    header("Location: home.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Pokopy</title>
	<link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/index.css">
    <script src="script/script.js"></script>
</head>
<body>



    <div class="background"></div>

    <div class="my-navbar">
        <img src="images/pokopyLogo.png" />
        <img src="images/title.png" id="titleImg"/>
    </div>
    <div class="navbar">
    <div class="main-pages">
            <a href="home.php">Home</a>
            <a href="pokedex/pokedex.php">Pokedex</a>
            <a href="explore/explore.php">Explore</a>
        </div>
        <div class="account-pages">
            <a href="registration.php">Sign Up</a>
        </div>
    </div>

    


    <div class="main-container">

        <?php 
            if (isset($_GET['error'])) {
            echo '<p class="error">'.$_GET['error'].'</p>';
            }
            if (isset($_GET['message'])) {
                echo '<p class="message">'.$_GET['message'].'</p>';
            }
        ?>

        <form action="login.php" method="post" class="form">
            <h2>Login</h2>
            <br>

            <div class="info-container">
                <label class="label">Username or Email Address</label>
                <input type="text" name="u_name" placeholder="Enter Username or Email Address" class="input"><br>

                <label class="login">Password</label>
                <input type="password" name="u_pass" placeholder="Enter Password" class="input"><br>

                <div>
                    <a href="forgotPassword.php">Forgot your password?</a>
                </div>
                
                <div class="button-container">
                    <button type="submit">Login</button>
                </div>
            </div>

            <div class="signup-container">
                <a href="registration.php">Don't have an account?<br>SIGN UP</a>
            </div>

        </form>
	<div>




</body>
</html>



