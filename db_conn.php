<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pokebuy";

$spoj = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($spoj->connect_error) {
  die("An error has occured: " . $spoj->connect_error);
}


?>