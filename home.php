<?php
session_start();

require_once 'database/db_manager.php';


if(!isset($_SESSION['user'])){
    header("Location: index.php?error=Please Log in.");
    exit();
}
if(!$_SESSION['user']['hasFinishedTutorial']){
    header("Location: tutorial/tutorial.php");
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
            <a href="pokedex/pokedex.php">Pokedex</a>
            <a href="explore/explore.php">Explore</a>
        </div>
        <div class="account-pages">
            <a href="logout.php">Log Out</a>
            <span id="username-text"><?php echo $_SESSION['user']['username']; ?></span>
            <div class="tooltip">
                <span id="stamina-text" onmouseout="removeStaminaInfo();" onmouseenter="addStaminaInfo();"></span>
                <span class="stamina-info"></span>
            </div>
            
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

        <div style="display:flex; flex-direction:column; margin: 2em; justify-content: center;">
            <img style="width:14%; margin:auto 43%" src="images/professorOak.png"/>
            <h1>Go to the Pokedex tab to see all the pokemons you have caught or go to the Explore tab to use up your stamina and catch some Pokemons</h1>
        </div>


	<div>



    <script>
        var staminaFloat = <?php echo $database->getStamina($_SESSION['user']['id']); ?>;
        initializeStamina(staminaFloat);
        initializeWindowTracker();
    </script>

</body>
</html>