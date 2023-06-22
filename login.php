<?php 
session_start(); 

require_once "database/db_manager.php";
require_once "utilities/functions.php";

if (isset($_POST['u_name']) && isset($_POST['u_pass'])) {

	$uname = validateInput($_POST['u_name']);
	$pass = validateInput($_POST['u_pass']);

	if (empty($uname)) {
		header("Location: index.php?error=Please enter username");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Please enter password");
	    exit();
	}else{
		$response = $database->loginUser($uname, $pass);
		
		header($response);
		exit();

	}
	
}else{
	header("Location: index.php");
	exit();
}
?>
