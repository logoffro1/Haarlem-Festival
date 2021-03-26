<?php
    include '../classes/autoloader.php';

    class jazzIntroController
    {
        private jazzIntroService $jazzIntroService;

        public function __construct() 
        {
            try
            {
            $this->jazzIntroService = new jazzIntroService();
            }
            catch(Exception $e)
            {
                throw ($e->getMessage());
            }
        }

        public function getHeaderInfo()
        {
            try
            {
                return $this->jazzIntroService->getHeaderInfo();
            }
            catch(Exception $e)
            {
                throw ($e->getMessage());
            }
        }
    }
    
?>