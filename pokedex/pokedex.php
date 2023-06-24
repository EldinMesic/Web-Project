<?php
session_start();

require_once '../database/db_manager.php';
$absPath = "http://localhost/Web-Project/";


if(!isset($_SESSION['user'])){
    header("Location: {$absPath}index.php?error=Please Log in.");
    exit();
}
if(!$_SESSION['user']['hasFinishedTutorial']){
    header("Location: {$absPath}tutorial/tutorial.php");
    exit();
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Pokopy</title>
	<link rel="stylesheet" href="../style/style.css">

    <link rel="stylesheet" href="../style/pokedex.css">
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
            <span class="current-page-button">Pokedex</span>
            <a href="../explore/explore.php">Explore</a>
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

    
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

    
    <div class="main-container">

        <?php 
            if (isset($_GET['error'])) {
            echo '<p class="error">'.$_GET['error'].'</p>';
            }
            if (isset($_GET['message'])) {
                echo '<p class="message">'.$_GET['message'].'</p>';
            }
        ?>


        <div class="page-buttons-container">
            <gr>
                <button class="prev-button blue-hover-btn disable-button">Prev</button>
                <span class="page-badge">1</span>
                <button class="next-button blue-hover-btn">Next</button>

                <g>
                    <span>Per Page:</span>
                    <select class="form-select " id="pppDropdown">
                    <option >10</option>
                    <option >20</option>
                    <option >50</option>
                    <option >100</option>
                    <option value="151">All</option>
                    </select>
                </g>
            </gr>

            <g class = "dropdown">
                <span>Sort By:</span>
                <select class="form-select " id="sbDropdown">
                    <option value="id">Pokemon ID</option>
                    <option value="name">Pokemon Name</option>
                    <option value="count">Number Caught</option>
                    <option value="location">Location</option>
                    <option value="rarity">Rarity</option>
                </select>
            </g>
    
        </div>


        <div class="items-grid">
            <img class="loading-image" src="../images/pokeballLoading.gif">
        </div>


        <div class="page-buttons-container">
            <gr>
                <button class="prev-button blue-hover-btn disable-button">Prev</button>
                <span class="page-badge">1</span>
                <button class="next-button blue-hover-btn">Next</button>
            </gr>
        </div>


	<div>



    <script src="../script/pokedex.js"></script>
    <script>
        var staminaFloat = <?php echo $database->getStamina($_SESSION['user']['id']); ?>;
        initializeStamina(staminaFloat);
        initializeWindowTracker();

        var pokemons = <?php echo $database->getPokemons(); ?>;
        var userPokemons = <?php echo $database->getUserPokemons($_SESSION['user']['id']) ?>;

        loadPokemon(pokemons, userPokemons);
    </script>

</body>
</html>