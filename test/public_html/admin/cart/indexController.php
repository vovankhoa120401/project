<?php
include 'cartbusiness.php';

$cart = new cart('asdasd');
if(isset($_POST['addCart'])){
    if(isset($_POST['amount'])){
        $cart->addcart($_POST['id'] , $_POST['amount']);   
    } else {
        $cart->addcart($_POST['id'] , 1);   
    }
}

if(isset($_POST['delProduct'])){
    $cart->delProduct($_POST['id']);   
}
