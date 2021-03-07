<?php
    include '../classes/autoloader.php';

    class cuisineEventController
    {
        private cuisineEventService $cuisineEventService;
        private string $name;

        public function __construct() {
            $this->cuisineEventService = new cuisineEventService();
            
        }    
       
    }
    
?>