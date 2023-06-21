<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Uređivanje proizvoda</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<?php
		include "db_conn.php";
		if (isset($_GET['id']) && !isset($_POST["izmjena"])){
			$sql = "SELECT * FROM proizvodi WHERE id=?";
			$stmt = $spoj->prepare($sql);
			$stmt->bind_param("i", $_GET['id']);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($db_id, $db_naziv, $db_kolicina, $db_cijena);

			if ($stmt->num_rows == 1){
				$stmt->fetch();
			?>
			<form action="" method="post">
				<h2>Uredite proizvod:</h2>
				<input type="hidden" name="id" value="<?php echo $db_id;?>">
				<label>Naziv</label>
				<input type="text" name="naziv" value="<?php echo $db_naziv;?>"><br>

				<label>Količina</label>
				<input type="number" name="kolicina" value="<?php echo $db_kolicina;?>"><br>
				
				<label>Cijena</label>
				<input type="text" name="cijena" value="<?php echo $db_cijena;?>"><br>

				<button type="submit" name="izmjena">Spremi promjene</button>
			</form>
			<div>
				<a href="ispis.php">Povratak na ispis</a>
			</div>
			<?php		
			}else{
				header("Location: ispis.php?error=Nije moguće urediti proizvod");
				exit();
			}
			$spoj->close();
			
		}else{                             
			$sql="UPDATE proizvodi SET naziv='$_POST[naziv]', kolicina='$_POST[kolicina]', cijena='$_POST[cijena]' WHERE id='$_POST[id]'";
			if ($spoj->query($sql) === TRUE)
			{
			  if ($spoj->affected_rows > 0 )
			  {
				  echo "Informacije o proizvodu su uspješno uređene.";
				  echo "<br><br><a href='ispis.php'>Ispis proizvoda</a>"; 
			  }
			  else
			  {
				  echo "Informacije o proizvodu nisu izmjenjene.";
				  echo "<br><br><a href='ispis.php'>Ispis proizvoda</a>"; 
			  }
			}
			else
			{
			  echo "Nastala je greška pri izmjeni podataka<br />" . $spoj->error;
			  echo "<br><br><a href='ispis.php'>Ispis proizvoda</a>"; 
			}
			$spoj->close();		   
		}
	?>









</body>
</html>