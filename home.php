<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: index.php?error=Please Log in.");
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
            <span class="current-page-button">Home</span>
            <a href="pokedex.php">Pokedex</a>
            <a href="explore.php">Explore</a>
        </div>
        <div class="account-pages">
            <a href="logout.php">Log Out</a>
            <span><?php echo $_SESSION['user']['username']; ?></span>
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

	<div>




</body>
</html>