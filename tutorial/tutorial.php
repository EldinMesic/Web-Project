<?php
session_start();

require_once '../database/db_manager.php';
require_once '../utilities/functions.php';


if(!isset($_SESSION['user'])){
    header("Location: ../index.php");
    exit();
}
if($_SESSION['user']['hasFinishedTutorial']){
    header("Location: ../index.php");
    exit();
}


?>


<!DOCTYPE html>
<html>
<head>
	<title>Pokopy</title>
	<link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/tutorial.css">
    <script src="../script/script.js"></script>
    <script src="../script/tutorial.js"></script>
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
            <a href="../pokedex.php">Pokedex</a>
            <a href="../explore.php">Explore</a>
        </div>
        <div class="account-pages">
            <a href="../logout.php">Log Out</a>
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

        <div class="pokemon-selection-container"  id="navbar">
            <div class="profesor-oak-container">
                <img id="prof-oak-img" src="../images/professorOak.png" />
                <div id="speech-bubble">
                    <div id="text-bubble">
                        <p></p>
                    </div>
                    
                </div>
            </div>

        </div>


        <div class="pokemon-container">
            <img data-name="bulbasaur" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png" />
            <img data-name="charmander" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/4.png" />
            <img data-name="squirtle" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/7.png" />
        </div>

    </div>


    <div class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2></h2>
            <div>
                <form action="completeTutorial.php" method="post">
                    <button id="yes-btn" type="submit" name="pokemonID" value="">Yes</button>
                </form>  
                <button id="no-btn">No</button>
            </div>
        </div>
    </div>





    <script>
        startSpeech( "<?php echo $_SESSION['user']['username']; ?> ");
    </script>
</body>
</html>