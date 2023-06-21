<?php 
session_start();
include 'utilities/functions.php';


if (isset($_SESSION['products'])) {

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Web Shop</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	<script src="script.js"></script>

  </head>
  <body>


    <div class="my-navbar">
      <img src="images/PokeBuyLogo.png" />
      <img src="images/title.png" id="titleImg"/>
    </div>


    <div class="main-container">
      <div class="cart-container">
        <button class="cart-button blue-hover-btn" onclick='window.location.assign("cart.php")'>Cart 
			    <span class="cart-badge">
				  <?php
          echo getCartItems();
				  ?>
			    </span>
		    </button>
      </div>
      <br><br>


      <?php 
		  if (isset($_GET['error'])) { 
		  ?>
		  <p class="error"><?php echo $_GET['error']; ?></p>
		  <?php } ?>
      <?php 
		  if (isset($_GET['message'])) { 
		  ?>
		  <p class="message"><?php echo $_GET['message']; ?></p>
		  <?php } ?>

      <div class="items-grid">
		  <?php foreach($_SESSION['products'] as $pokemon){ ?>
      <script>
        createPokemon( <?php echo json_encode($pokemon); ?> );
      </script>		
		  <?php } ?>
      </div>

    </div>
    
    
  </body>
</html>


<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>