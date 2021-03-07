<?php
    class performanceController {
        private performanceService $performanceService;
        private helper $helper;

        public function __construct() {
            $this->helper = new helper();
            $this->performanceService = new performanceService();
        }

        public function addPerformance() : void
        {
            $this->performanceService->addPerformance();
        }
    }
?>