<?php
session_start();

include 'functions.php';


if(isset($_POST['quantity']) && isset($_POST['id'])){
    $quantity = $_POST['quantity'];
    $id = $_POST['id'];

    $pokemon = $_SESSION['products'][$id];

    
    if(isset($_SESSION['cart']) || !empty($_SESSION['cart'])){

        $status = addToCart($pokemon, $quantity);

        header('Location: home.php?message='.$status);
        exit();

    }else{
        $_SESSION['cart'] = array(
            array(
            'name'=>$pokemon['name'],
            'id'=>$pokemon['id'],
            'price'=>$pokemon['price'],
            'quantity'=>$quantity,
            'image'=>$pokemon['image'])
        );
        header('Location: home.php?message=You have successfully added '.$pokemon['name'].' to your cart');
        exit();
    }

}else{
    header("Location: home.php");
    exit();
}
?>