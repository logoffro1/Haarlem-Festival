<?php
    include '../classes/autoloader.php';

    $purchaseController = new purchaseController();
    $pdfController = new pdfController();
    $mailController = new mailController();

    try {
        $metaData = $purchaseController->getPayment();
    
        if($metaData['isPaid']){
            $cart = $_SESSION['cart'];
            
            $pdf = $pdfController->createPdf($_POST['id']);

            $mailController->sendMail(
                $metaData['email'], 
                "Haarlem Festival Tickets", 
                "This is your generated invoice for the Haarlem Festival events.",
                $metaData['fullname'], 
                $pdf,
            );
        }
    } catch(Exception $e){
        echo $e->getMessage();
    }
?>