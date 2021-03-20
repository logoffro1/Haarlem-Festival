<?php
    include '../classes/autoloader.php';

    class purchaseController extends controller {
        private pruchaseService $pruchaseService;

        public function __construct() {
            parent::__construct();
            $this->pruchaseService = new pruchaseService();
        }

        public function getPurchaseList() : array
        {
            $this->pruchaseService->getPurchaseList();
        }
    }
?>