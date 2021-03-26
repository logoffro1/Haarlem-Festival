<?php
    include '../classes/autoloader.php';
    include '../components/cart/cartSession.php';
    
    $head = new head("Your Cart | Haarlem Festival", "");
    $head->render();

    $navigation = new navigation("");
    $navigation->render();
    
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