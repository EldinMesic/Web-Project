<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Unos proizvoda</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<?php
		include "db_conn.php";
		if (isset($_POST['unos']) && !empty($_POST['naziv']) && !empty($_POST['kolicina']) && !empty($_POST['cijena'])) {
			
			function validate($data){
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			$naziv = validate($_POST['naziv']);
			$kolicina = validate($_POST['kolicina']);
			$cijena = validate($_POST['cijena']);
			
			if (empty($naziv)) {
				header("Location: unos.php?error=Niste unjeli naziv proizvoda.");
				exit();
			}else if (empty($kolicina)) {
				header("Location: unos.php?error=Niste unjeli količinu.");
					exit();
			}else if(empty($cijena)){
				header("Location: unos.php?error=Niste unjeli cijenu.");
				exit();
			}else{
				$stmt = $spoj->prepare("INSERT INTO proizvodi (naziv, kolicina, cijena) VALUES (?, ?, ?)");
				$stmt->bind_param("sis", $naziv, $kolicina, $cijena);

				$rezultat= $stmt->execute();
				if ($rezultat) {
					echo "Proizvod dodan u bazu";
					echo '<a href="unos.php">Unos proizvoda</a>';
					echo '<a href="ispis.php">Ispis proizvoda</a>';
					echo '<a href="logout.php">Odjava</a>';
				}else{
					header("Location: unos.php?error=Nešto je krenulo po zlu");
					exit();
				}
				$spoj->close();
			}
        }else{
		?>
		<form action="" method="post">
			<h2>Unesite proizvod:</h2>
			<?php 
			if (isset($_GET['error'])) { 
			?>
			<p class="error"><?php echo $_GET['error']; ?></p>
			<?php } ?>
			<label>Naziv</label>
			<input type="text" name="naziv" placeholder="Unesite naziv proizvoda"><br>

			<label>Količina</label>
			<input type="number" name="kolicina" placeholder="Unesite količinu"><br>
			
			<label>Cijena</label>
			<input type="text" name="cijena" placeholder="Unesite cijenu s dvije decimale 9.99"><br>

			<button type="submit" name="unos">Spremi</button>
		</form>
		<div>
			<a href="registracija.php">Registriraj se</a>
		</div>
		<?php
		}
		?>

</body>
</html>