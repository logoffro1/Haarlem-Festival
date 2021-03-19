<?php
    include '../classes/autoloader.php';

    class jazzIntroController
    {
        private jazzIntroService $jazzIntroService;

        public function __construct() {
            $this->jazzIntroService = new jazzIntroService();
        }

        public function getHeaderInfo()
        {
            return $this->jazzIntroService->getHeaderInfo();
        }
    }
    
?>