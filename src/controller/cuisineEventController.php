<?php
    include '../classes/autoloader.php';

    class cuisineEventController
    {
        private cuisineEventService $cuisineEventService;

        public function __construct() {
            $this->cuisineEventService = new cuisineEventService();
        }
    }
    
?>