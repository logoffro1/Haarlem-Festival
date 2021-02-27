<?php
    include '../classes/autoloader.php';

    class cuisineEventController
    {
        private cuisineEventService $jazzEventService;

        public function __construct() {
            $this->cuisineEventService = new cuisineEventService();
        }
    }
    
?>