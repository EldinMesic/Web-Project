<?php
session_start();

include 'functions.php';

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
            <button class="cart-button blue-hover-btn" onclick='window.location.assign("home.php")'>Home</button>
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

        <div class="items-grid-2">
            <form action="order.php" method="post" class="flex-row" style="justify-content:center;">
                <button class="cart-buy-btn" type="submit" name="order" value="order">Buy Everything</button>
                <h2>Total Cost of all items in Cart: $<?php echo getTotalCartCost() ?></h2>
        </form>
            
            <?php
            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $cartItem){ ?>
                    <script>
                        createCartItem( <?php echo json_encode($cartItem); ?> );
                    </script>		
                <?php }
            }else{
                echo '<div style="text-align:center;"><h2>There are no items in your cart</h2></div>';
            }
            ?>
        </div>

    </div>
    
    
  </body>
</html>