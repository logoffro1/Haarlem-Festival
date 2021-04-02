<?php
    include '../classes/autoloader.php';

    $purchaseController = new purchaseController();
    $pdfController = new pdfController();
    $mailController = new mailController();

    try {
        // Get payment meta data and isPaid boolean
        $metaData = $purchaseController->getPayment();
    
        // If the transaction is payed
        if($metaData['isPaid']){
            // Get bought tickets from session
            $cart = $_SESSION['cart'];
            
            // Add the reservation to the database 
            $purchaseController->createReservations( $metaData['fullname'], $metaData['email'], $cart);
            
            // Create invoice based on bought tickets from session
            $pdf = $pdfController->createPdf($_POST['id'], $metaData['fullname']);
            
            // Send to email with pdf, based on the email from the meta data
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