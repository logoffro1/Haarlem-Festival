<?php
    include '../classes/autoloader.php';

    $purchaseController = new purchaseController();
    
    $helper = new helper();
    $helper->startSession();

    try {
        // Get payment meta data and isPaid boolean
        $metaData = $purchaseController->getPayment();
    
        // If the transaction is payed
        if($metaData['isPaid']){
            $purchaseController->changePurchaseStatusFromMollie(1, (int)$metaData['order_id']);
        } else {
            $purchaseController->deletePurchase((int)$metaData['order_id']);
        }
    } catch(Exception $e){
        echo $e->getMessage();
    }
?>