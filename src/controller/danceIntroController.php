<?php
    include '../classes/autoloader.php';

    class danceIntroController
    {
        private danceIntroService $danceIntroService;

        public function __construct() {
            $this->danceIntroService = new danceIntroService();
        }

        public function getHeaderInfo()
        {
            return $this->danceIntroService->getHeaderInfo();
        }
    }
?>