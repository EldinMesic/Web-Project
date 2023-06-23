<?php
session_start();

require_once '../database/db_manager.php';


if(!isset($_POST['pokemonID'])){
    header("Location: ../index.php");
    exit();
}

$database->finishTutorial($_SESSION['user']['id'], $_POST['pokemonID']);






?>