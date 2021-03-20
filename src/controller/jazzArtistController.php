<?php
    include '../classes/autoloader.php';

    class jazzArtistController
    {
        private jazzArtistService $jazzArtistService;

        public function __construct() {
            $this->jazzArtistService = new jazzArtistService();
        }

        public function getAJazzArtistById(int $id)
        {
            return $this->jazzArtistService->getAJazzArtistById($id);
        }

        public function getAllJazzArtists()
        {
            return $this->jazzArtistService->getAllJazzArtists();
        }
    }
    
?>