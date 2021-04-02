<?php
    include '../classes/autoloader.php';

    class pdfController extends controller {
        private pdfInvoice $pdfInvoice;

        public function __construct(pdfInvoice $pdfInvoice) {
            parent::__construct();
            $this->pdfInvoice = $pdfInvoice;
        }

        public function createPdf(string $id, string $email, $name)
        {
            new pdfInvoice($id, $_SESSION['cart'],$email, $name);
        }
    }
?>