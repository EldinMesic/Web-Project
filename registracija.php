<!DOCTYPE html>
<html>
<head>
	<title>Naslovna</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="register.php" method="post">
     	<h2>Podaci za registraciju:</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
			<label>Vaše ime</label>
     	<input type="text" name="ime" placeholder="Your Name"><br>

     	<label>Korisničko ime</label>
     	<input type="text" name="k_ime" placeholder="User Name"><br>

     	<label>Lozinka</label>
     	<input type="password" name="lozinka" placeholder="Password"><br>

			<label>Ponovite lozinku</label>
     	<input type="password" name="lozinka2" placeholder="Password one more time"><br>

     	<button type="submit">Registriraj se</button>
     </form>
		 <div>
			<a href="index.php">Prijava</a>
		 </div>

</body>
</html>