<?php 
session_start(); 

require_once "database/db_manager.php";
require_once "utilities/functions.php";

if (isset($_POST['u_name']) && isset($_POST['u_email']) && isset($_POST['u_pass']) && isset($_POST['u_pass_confirm'])) {

	$uname = validateInput($_POST['u_name']);
	$email = validateInput($_POST['u_email']);
	$pass = validateInput($_POST['u_pass']);
	$passConfirm = validateInput($_POST['u_pass_confirm']);

	if (empty($uname)) {
		header("Location: registration.php?error=Please enter username");
	    exit();
	}else if (filter_var($uname, FILTER_VALIDATE_EMAIL)) {
		header("Location: registration.php?error=Username cannot contain special characters");
		exit();
	}else if (empty($email)) {
		header("Location: registration.php?error=Please enter valid email address");
		exit();
	}else if(empty($pass)){
        header("Location: registration.php?error=Please enter password");
	    exit();
	}else if($pass != $passConfirm){
		header("Location: registration.php?error=Passwords do not match");
		exit();
	}else{
		$response = $database->registerUser($uname, $email, $pass);

		header($response);
		exit();
		
	}
	
}else{
	header("Location: index.php");
	exit();
}
?>