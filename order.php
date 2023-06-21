<?php
session_start();


if(isset($_POST['order'])){
    if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
        header("Location: cart.php?error=Why would you want to order nothing?");
        exit();
    }
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
        <button class="cart-button blue-hover-btn" onclick='window.location.assign("cart.php")'>Back to Cart</button>

        <form class="form" action="emptyCart.php" method="post">
            <h2>Order Details:</h2>
            
            <label class="label">Your full name</label>
            <input class="input" type="text" name="fullname" placeholder="Your Full Name"><br>

            <label class="label">Your email address</label>
            <input class="input" type="email" name="email" placeholder="youremail@gmail.com"><br>

            <label class="label">Your Address</label>
            <input class="input" type="text" name="address" placeholder="Country, City, Street Name"><br>

            <label class="label">Your Phone Number</label>
            <input class="input" type="tel" name="telephone" placeholder="(+385)12 345 6789"><br>

            <button type="submit">Make Order</button>   
        </form>



    </div>
    
    
  </body>
</html>
























<?php
}else{
    header("Location: home.php");
    exit();
}
?>

