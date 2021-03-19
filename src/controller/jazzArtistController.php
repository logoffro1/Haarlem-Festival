<?php
    include '../classes/autoloader.php';

    class jazzArtistController
    {
        private jazzArtistService $jazzArtistService;

        public function __construct() {
            $this->jazzArtistService = new jazzArtistService();
        }

        public function getAnArtistById(int $id)
        {
            return $this->jazzArtistService->getAnArtistById($id);
        }

        public function getAllJazzArtists()
        {
            return $this->jazzArtistService->getAllJazzArtists();
        }
    }
    
?>