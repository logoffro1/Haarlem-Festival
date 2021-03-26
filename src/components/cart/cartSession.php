<?php
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

    if($_GET['type'] == 'jazz')
       $_SESSION['cart']->addItemToCart($id, "jazz");
}

if(isset($_GET['action']))
{
    if ($_GET['action'] == 'remove')
    {
        $cartItems = $_SESSION['cart']->__get('cartItems');
        $selectedIndex = intval($_GET['cartItemId']);  
        unset($cartItems[$selectedIndex]);
        $_SESSION['cart']->setCartItems($cartItems);
        
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