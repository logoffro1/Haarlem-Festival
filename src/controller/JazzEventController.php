<?php
    include '../classes/autoloader.php';

    class jazzEventController
    {
        private jazzEventService $jazzEventService;

        public function __construct() {
            $this->jazzEventService = new jazzEventService();
        }
    }
    
?>