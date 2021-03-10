<?php
    include '../classes/autoloader.php';

    class performanceController extends controller {
        private performanceService $performanceService;

        public function __construct() {
            $this->performanceService = new performanceService();
        }

        public function addPerformance() : void
        {
            $this->performanceService->addPerformance();
        }
    }
?>