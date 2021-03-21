<?php
    include '../classes/autoloader.php';

    class dancePerformanceController
    {
        private dancePerformanceService $dancePerformanceService;

        public function __construct() {
            $this->dancePerformanceService = new dancePerformanceService();
        }

        public function getAllDancePerformances()
        {
            return $this->dancePerformanceService->getAllDancePerformances();
        }
    }

?>