<?php
    include '../classes/autoloader.php';

    class danceArtistController
    {
        private danceArtistService $danceArtistService;

        public function __construct() {
            $this->danceArtistService = new danceArtistService();
        }

        public function getADanceArtistById(int $id)
        {
            return $this->danceArtistService->getADanceArtistById($id);
        }

        public function getAllDanceArtists()
        {
            return $this->danceArtistService->getAllDanceArtists();
        }
    }
?>