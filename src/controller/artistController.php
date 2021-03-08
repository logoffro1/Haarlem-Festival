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

        public function getArtist() : artist {
            $artistId = $_GET["id"];

            return $this->artistService->getArtist($artistId);
        }

        public function updateArtist(artist $artist) : void
        {
            $data = [
                'title' => $_POST['title'] ?? NULL,
                'page_content' => $_POST['page_content'] ?? NULL,
                'youtube' => $_POST['youtube'] ?? NULL,
                'instagram' => $_POST['instagram'] ?? NULL,
                'facebook' => $_POST['facebook'] ?? NULL
            ];

            $this->artistService->updateArtist($artist, $data);
        }

        public function updateArtistImage(artist $artist) : void
        {
            $data = [
                'image' => $_FILES['image']
            ];

            $this->artistService->updateArtistImage($artist, $data);
        }

        public function createSession(artist $artist) : void
        {
            $this->helper->startSession();
            $_SESSION["artist"] = serialize($artist);
        }
        
        public function getSession() : ?artist
        {
            $this->helper->startSession();
            if(isset($_SESSION['artist'])){
                return unserialize($_SESSION["artist"]);
            }

            return null;
        }
    }
?>