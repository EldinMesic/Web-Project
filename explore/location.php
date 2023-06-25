<?php
session_start();

require_once '../database/db_manager.php';



if(!isset($_POST['location'])  || !isset($_POST['cost'])){
    header("Location: explore.php");
    exit();
}
if(!isset($_SESSION['user'])){
    header("Location: ../index.php?error=Invalid Session");
    exit();
}



//if( !($database->useStamina($_SESSION['user']['id'], $_POST['cost'])) ){
//    header("Location: explore.php?error=You don't have enough stamina to explore that area");
//    exit();
//}


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
            <span class="current-page-button">Home</span>
            <span class="current-page-button">Pokedex</span>
            <span class="current-page-button">Explore</span>
        </div>
        <div class="account-pages">
            <span class="current-page-button" style="float:right;">Log Out</span>
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

        
        <div class="pokemon-container">
            <form action="catchPokemon.php" method="post">
                <button type="submit" name="pokemonID" value="">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png" />
                </button>
            </form>
            
        </div>


	<div>


    <script src="../script/explore.js"></script>
    <script>
        var staminaFloat = <?php echo $database->getStamina($_SESSION['user']['id']); ?>;
        initializeStamina(staminaFloat);
        initializeWindowTracker();

        explorePokemons(<?php echo $database->getPokemonsInLocations(); ?>);
    </script>

</body>
</html>