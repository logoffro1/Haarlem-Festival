<?php
    include '../classes/autoloader.php';

    class songController
    {
        private songService $songService;

        public function __construct() {
            $this->songService = new songService();
        }

        public function getSongsByArtistId(int $id)
        {
            return $this->songService->getSongsByArtistId($id);
        }
    }

?>