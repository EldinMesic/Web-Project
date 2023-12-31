<?php
session_start();

require_once '../database/db_manager.php';


if(!isset($_SESSION['user'])){
    header("Location: ../index.php?error=Please Log in.");
    exit();
}
if(!$_SESSION['user']['hasFinishedTutorial']){
    header("Location: ../tutorial/tutorial.php");
    exit();
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Pokopy</title>
	<link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/explore.css">
    <script src="../script/script.js"></script>
</head>
<body>

    <div class="background"></div>

    <div class="my-navbar">
      <img src="../images/pokopyLogo.png" />
      <img src="../images/title.png" id="titleImg"/>
    </div>
    <div class="navbar">
        
        <div class="main-pages">
            <a href="../home.php">Home</a>
            <a href="../pokedex/pokedex.php">Pokedex</a>
            <span class="current-page-button">Explore</span>
        </div>
        <div class="account-pages">
            <a href="../logout.php">Log Out</a>
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


        <div class="explore-container">

        </div>


	<div>


    <script src="../script/explore.js"></script>
    <script>
        var staminaFloat = <?php echo $database->getStamina($_SESSION['user']['id']); ?>;
        initializeStamina(staminaFloat);
        initializeWindowTracker();

        initializeLocations(<?php echo $database->getPokemonsInLocations(); ?>);
    </script>

</body>
</html>