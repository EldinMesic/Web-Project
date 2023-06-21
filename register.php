<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['ime']) && isset($_POST['k_ime']) && isset($_POST['lozinka']) && isset($_POST['lozinka2'])) {

	function validate($data){
    $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$name = validate($_POST['ime']);
	$uname = validate($_POST['k_ime']);
	$pass = validate($_POST['lozinka']);
	$pass2 = validate($_POST['lozinka2']);

	if (empty($name)) {
		header("Location: registracija.php?error=Niste unjeli vaše ime");
	    exit();
	}else if (empty($uname)) {
				header("Location: registracija.php?error=Niste unjeli korisničko ime");
					exit();
	}else if(empty($pass)){
        header("Location: registracija.php?error=Niste unjeli lozinku");
	    exit();
	}else if($pass != $pass2){
			header("Location: registracija.php?error=Niste unjeli jednake lozinke");
		exit();
	}else{
		$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
		$stmt = $spoj->prepare("INSERT INTO korisnici (name, user_name, password) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $name, $uname, $hashed_pass);

		$rezultat= $stmt->execute();

		if ($rezultat) {
			$sql = "SELECT * FROM korisnici WHERE user_name=?";
			$stmt = $spoj->prepare($sql);
			$stmt->bind_param("s", $uname);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($db_userid, $db_name, $db_username, $db_paswordHASH);

			if ($stmt->num_rows == 1) {
				$stmt->fetch();
				if (password_verify($pass, $db_paswordHASH)) {
					$_SESSION['id'] = $db_userid;
					$_SESSION['user_name'] = $db_username;
					$_SESSION['name'] = $db_name;
					if (isset($_SESSION['id']) && isset($_SESSION['user_name']))
					header("Location: home.php");
					exit();
				}else{
					header("Location: index.php?error=Neispravna lozinka");
					exit();
				}
			}else{
				header("Location: index.php?error=Neispravno korisničko ime");
				exit();
			}
			$conn->close();





		} else{
			header("Location: registracija.php?error=Nešto je krenulo po zlu");
			exit();
		}
		$spoj->close();
	}
	
}else{
	header("Location: index.php");
	exit();
}
?>