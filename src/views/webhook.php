<?php
    include '../classes/autoloader.php';

    $purchaseController = new purchaseController();

    if(isset($_POST['id'])){
        $purchaseController->getPayment();
    }
?>