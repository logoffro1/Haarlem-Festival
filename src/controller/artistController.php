<?php
    include '../classes/autoloader.php';

    class artistController {
        private artistService $artistService;
        private helper $helper;

        public function __construct() {
            $this->helper = new helper();
            $this->artistService = new artistService();
        }

        public function getJazzArtistList() : array
        {
            return $this->artistService->getArtistList(1); // Todo change id to correct jazz page id in database
        }
    
        public function getDanceArtistList() : array
        {
            return $this->artistService->getArtistList(2); // Todo change id to correct jazz page id in database
        }

        public function getArtist(){
            $artistId = $_GET["artistId"];

            return $this->artistService->getArtist($artistId);

        }
    }
?>