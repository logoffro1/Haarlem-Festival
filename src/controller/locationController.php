<?php
    include '../classes/autoloader.php';

    class locationController extends controller {
        private locationService $locationService;

        public function __construct() {
            $this->locationService = new locationService();
        }

        public function getDanceLocations() : ?array
        {
            return $this->locationService->getDanceLocations();
        }

        public function getJazzLocations() : ?array
        {
            return $this->locationService->getJazzLocations();
        }
    }
?>