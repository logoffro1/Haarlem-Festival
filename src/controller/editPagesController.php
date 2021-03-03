<?php
    include '../classes/autoloader.php';

    class editPagesController
    {
        private editPagesService $editPagesService;

        public function __construct() {
            $this->editPagesService = new editPagesService();
        }

        public function getPagesList() : ?array
        {
            return $this->editPagesService->getPagesList();
        }

        public function getPageDetails()
        {
            return $this->editPagesService->getPageDetails();
        }
    }
    
?>