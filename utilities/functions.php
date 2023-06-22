<?php

function validateInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}




function getCartItems(){
    if(isset($_SESSION['cart'])){
        $count = 0;
        foreach($_SESSION['cart'] as $cartItem){

            $count += $cartItem['quantity'];
        }
        return $count;

    }else{
        return 0;
    }
}

function getTotalCartCost(){
    if(isset($_SESSION['cart'])){
        $cost = 0;
        foreach($_SESSION['cart'] as $cartItem){

            $cost += $cartItem['quantity']*$cartItem['price'];
        }
        return $cost;

    }else{
        return 0;
    }
}




function addToCart($item, $amount){
    $isInCart = false;
    $i = 0;
    foreach($_SESSION['cart'] as $cartItem){
        if($cartItem['id'] == $item['id']){
            $isInCart = true;
            $_SESSION['cart'][$i]['quantity'] += $amount;
            return 'You have increased the amount of '.$item['name'].'s in your cart';
        }
        $i++;
    }

    if(!$isInCart){
        $itemArray =
            array(
                'name'=>$item['name'],
                'id'=>$item['id'],
                'price'=>$item['price'],
                'quantity'=>$amount,
                'image'=>$item['image']
            );

        $_SESSION['cart'][] = $itemArray;
        return 'You have successfully added '.$item['name'].' to your cart';
    }

    return 'Something went wrong';
}

function updateCart($item, $amount){
    $i = 0;
    foreach($_SESSION['cart'] as $cartItem){
        if($cartItem['id'] == $item['id']){
            if($amount<=0){
                array_splice($_SESSION['cart'], $i, 1);
                return 'You have removed '.$item['name'].'(s) from your cart';
            }else{
                $_SESSION['cart'][$i]['quantity'] = $amount;
                return 'You have updated the amount of '.$item['name'].'s in your cart';
            }
            
        }
        $i++;
    }

    return 'Something went wrong';
}

?>