<?php
    include '../classes/autoloader.php';

    class pdfController extends controller {
        public function __construct() {
            parent::__construct();
        }

        public function createPdf(int $id, string $name)
        {
            try {
                $pdfInvoice = new pdfInvoice(strval($id), $_SESSION['cart'], $name);
                return $pdfInvoice->generateInvoice();
            } catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }
?>