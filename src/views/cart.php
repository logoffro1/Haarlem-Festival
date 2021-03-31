<?php
    include '../classes/autoloader.php';
    include '../components/cart/cartSession.php';
    
    $head = new head("Your Cart | Haarlem Festival", "");
    $head->render();

    $navigation = new navigation("");
    $navigation->render();
    // Checking the count so that it can display empty cart information on the screen when no item is in cart
    if($_SESSION['cart']->getCountFromCart() > 0)
    {
        $cart = new cartDisplay($_SESSION['cart']);
        $cart->render();
    }
    else
    {
        $cart = new emptyCartDisplay();
        $cart->render();
    }
    $footer = new footer();
    $footer->renderFooter();
    $_SESSION['cart']->render();
?>