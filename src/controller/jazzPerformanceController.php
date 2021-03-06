<?php
    include '../classes/autoloader.php';

    class jazzPerformanceController
    {
        private jazzPerformanceService $jazzPerformanceService;

        public function __construct() {
            $this->jazzPerformanceService = new jazzPerformanceService();
        }

        public function getAllJazzPerformances()
        {
            return $this->jazzPerformanceService->getAllJazzPerformances();
        }
    }
    
?>