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
            return $this->purchaseService->getPurchaseList();
        }

        public function changePurchasePaymentStatus() : void
        {
            $isPayed = isset($_POST['isPayed']);
            $id = $_POST['purchaseId'];

            $this->purchaseService->changePurchasePaymentStatus($isPayed, $id);
            $this->helper->refresh();
        }
    }
?>