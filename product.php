<?php
session_start();

include 'functions.php';


if(isset($_POST['id']) && isset($_SESSION['products'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = validate($_POST['id']);
    if (!is_numeric($id)) {
		header("Location: home.php?error=Došlo je do pogreške prikaza Pokemona");
	    exit();
	}
    $pokemon = $_SESSION['products'][$_POST['id']];
?>

    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="UTF-8">
        <title>Web Shop</title>
        <link rel="stylesheet" type="text/css" href="style.css">
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
                <button class="cart-button blue-hover-btn" onclick='window.location.assign("home.php")'>Home</button>
            </div>
            <br><br>
    
            
            <div class="form flex-row">
                <?php echo '<img src="'.$pokemon['image'].'"  alt="'.$pokemon['name'].'">'; ?>
                <div class="flex-column">
                        <?php
                        echo '<h1>#'.$pokemon['id'].' '.$pokemon['name'].'</h1>';
                        echo '<h3 style="text-align:center;">'.$pokemon['description'].'</h3>';
                        echo '<h2>Price: $'.$pokemon['price'].'</h2>';
                        ?>
                        <form action="addToCart.php" method="post" class="flex-column">
                            <label>Quantity:</label>
                            <input type="number" name="quantity" min="1" value="1">
                            <br>
                            <?php
                            echo '<button class="add-to-cart-btn blue-hover-btn" type="submit" name="id" value="'.($pokemon['id']-1).'">Add To Cart</button>';
                            ?>
                        </form>
                </div>
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