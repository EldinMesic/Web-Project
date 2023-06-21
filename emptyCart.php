<?php
session_start();

if(isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['telephone'])){
    $_SESSION['cart'] = array();
    header("Location: cart.php?message=Thank you for your order");
    exit();

}else{
    header("Location: home.php");
    exit();
}

?>