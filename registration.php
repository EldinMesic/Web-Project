<?php
session_start();
session_unset();
session_destroy();
session_start();

require_once "database/db_manager.php";


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
            <a href="pokedex.php">Pokedex</a>
            <a href="explore.php">Explore</a>
        </div>
        <div class="account-pages">
            <a href="index.php">Log In</a>
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

        <form action="register.php" method="post" class="form">
            <h2>Register</h2>
            <br>

            <div class="info-container">
                <label class="label">Username</label>
                <input type="text" name="u_name" placeholder="example125" minlength="3" class="input"><br>

				<label class="label">Email</label>
                <input type="email" name="u_email" placeholder="example@example.com" class="input"><br>

                <label class="login">Password</label>
                <input type="password" name="u_pass" placeholder="pass1234" minlength="6" class="input"><br>

				<label class="login">Confirm Password</label>
                <input type="password" name="u_pass_confirm" placeholder="pass1234" minlength="6" class="input"><br>
                
                <div class="button-container">
                    <button type="submit">Register</button>
                </div>
            </div>

            <div class="signup-container">
                <a href="login.php">Already have an account?<br>LOGIN</a>
            </div>

        </form>
	<div>




</body>
</html>



