<?php
include __DIR__.'/../../classes/autoloader.php';

if (session_status() === PHP_SESSION_NONE) 
    session_start();

 if(empty($_SESSION['cart'])) 
 {
     $cart = new cart();
     $_SESSION['cart'] = $cart;
 }

if(isset($_GET['performanceID']))
{
    $id = $_GET['performanceID'];
    $artistId = $_GET['artist'];
    
    if($_GET['type'] == 'jazz')
        $_SESSION['cart']->addItemToCart($id, $artistId,"jazz");
    else if($_GET['type'] == 'dance')
        $_SESSION['cart']->addItemToCart($id, $artistId,"dance");
}

if(isset($_GET['action']))
{
    if ($_GET['action'] == 'remove')
    {
        $selectedIndex = intval($_GET['cartItemId']);  
        $_SESSION['cart']->removeAnItemByIndex($selectedIndex);
    }
    else if ($_GET['action'] == 'edit')
    {
        $cartItems = $_SESSION['cart']->__get('cartItems');
        $selectedIndex = intval($_GET['cartItemId']);  
        $newCount = intval($_GET['quantity']);
        $cartItems[$selectedIndex]->setCount($newCount);
        $_SESSION['cart']->setCartItems($cartItems);
    }
}
?>