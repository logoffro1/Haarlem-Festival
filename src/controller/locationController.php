<?php
    include '../classes/autoloader.php';

    class locationController {
        private locationService $locationService;
        private helper $helper;

        public function __construct() {
            $this->helper = new helper();
            $this->locationService = new locationService();
        }

        public function getLocations() : array
        {
            return $this->getDanceLocations();
        }
    }
?>