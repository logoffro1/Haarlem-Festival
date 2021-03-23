<?php
    include '../classes/autoloader.php';

    class locationController extends controller {
        private locationService $locationService;

        public function __construct() {
            parent::__construct();
            $this->locationService = new locationService();
        }

        public function getDanceLocations() : ?array
        {
            try {
                return $this->locationService->getDanceLocations();
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        public function getJazzLocations() : ?array
        {
            try {
                return $this->locationService->getJazzLocations();
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }
    }
?>