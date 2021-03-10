<?php
    include '../classes/autoloader.php';

    class songController extends controller {
        private songService $songService;

        public function __construct() {
            $this->songService = new songService();
        }


        public function addSong() : void
        {
            $this->artistService->addSong();
        }

        public function getSong() : ?song
        {
            if(isset($_GET["id"])){
                $songId = $_GET["id"];
                
                return $this->songService->getSong($songId);
            }

            return null;
        }

        public function updateSong(song $song) : void
        {
            try {
                $data = array(
                    'title'=>$_POST['title'],
                    'url'=>$_POST['url'],
                    'image'=>$_FILES["image"]?? ''
                );
    
                $this->songService->updateSong($song->id, $data);
                header("Refresh: 0");
            } catch(Exception $e) {
                echo $e;
            }
        }
    }
?>