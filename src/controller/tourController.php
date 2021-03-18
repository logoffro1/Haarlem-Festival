<?php
    include '../classes/autoloader.php';

    class tourController extends controller
    {
        private tourService $tourService;

        public function __construct() {
            $this->tourService = new tourService();
        }

        public function getAllTours() : array
        {
            return $this->tourService->getAllTours();
        }

        public function getTourByID(int $id) : tour
        {
            return $this->tourService->getTourByID($id);
        }
    }
    
?>