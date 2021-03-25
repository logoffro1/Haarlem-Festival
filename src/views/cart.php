<?php
    include '../classes/autoloader.php';
    include '../components/cart/cart.php';
    
    
    $head = new head("Your Cart | Haarlem Festival", "");
    $head->render();

    $navigation = new navigation("");
    $navigation->render();
    

    $cart = new cartDisplay($_SESSION['cart']);
    $cart->render();

    $footer = new footer();
    $footer->renderFooter();
    $_SESSION['cart']->render();
?>