<?php
    include '../classes/autoloader.php';

    class purchaseController extends controller {
        private purchaseService $purchaseService;

        public function __construct() {
            parent::__construct();
            $this->purchaseService = new purchaseService();
        }

        public function getPurchaseList() : ?array
        {
            try {
                return $this->purchaseService->getPurchaseList();
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        public function changePurchasePaymentStatus() : void
        {
            try {
                $isPayed = isset($_POST['isPayed']);
                $id = $_POST['purchaseId'];
    
                $this->purchaseService->changePurchasePaymentStatus($isPayed, $id);
                $this->helper->refresh();
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }
    }
?>