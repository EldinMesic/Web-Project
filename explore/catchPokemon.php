<?php
session_start();

require_once '../database/db_manager.php';



if(!isset($_SESSION['user'])){
    header("Location: ../index.php?error=Invalid Session");
    exit();
}
if(!isset($_POST['pokemonID']) || !isset($_POST['isShiny'])){
    header("Location: explore.php?error=Something went wrong. Please try again");
    exit();
}

$pokemon = json_decode($database->getPokemonById($_POST['pokemonID']));
$pokemonName = $pokemon->name;

if($database->catchPokemon($_SESSION['user']['id'], $_POST['pokemonID'], $_POST['isShiny'])){
    header("Location: explore.php?message=Success! You caught $pokemonName!");
}else{
    header("Location: explore.php?error=Something went wrong. Please try again");
    
}
exit();






















?>