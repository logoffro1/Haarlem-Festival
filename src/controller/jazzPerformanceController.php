<?php
    include '../classes/autoloader.php';

    class jazzPerformanceController
    {
        private jazzPerformanceService $jazzPerformanceService;

        public function __construct() 
        {
            try
            {
                $this->jazzPerformanceService = new jazzPerformanceService();
            }
            catch(Exception $e)
            {
                throw ($e->getMessage());
            }
        }

        public function getAllJazzPerformances()
        {
            try
            {
                return $this->jazzPerformanceService->getAllJazzPerformances();
            }
            catch(Exception $e)
            {
                throw ($e->getMessage());
            }
        }

        public function getAJazzPerformanceById(int $id)
        {
            try
            {
                return $this->jazzPerformanceService->getAJazzPerformanceById($id);
            }
            catch(Exception $e)
            {
                throw ($e->getMessage());
            }
        }
    }
    
?>