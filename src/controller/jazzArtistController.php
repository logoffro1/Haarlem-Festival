<?php
    include '../classes/autoloader.php';

    class jazzArtistController
    {
        private jazzArtistService $jazzArtistService;

        public function __construct() {
            $this->jazzArtistService = new jazzArtistService();
        }
    }
    
?>