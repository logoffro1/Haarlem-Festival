<?php
    include '../classes/autoloader.php';

    class songController extends controller {
        private songService $songService;

        public function __construct() {
            parent::__construct();
            $this->songService = new songService();
        }

        public function deleteSong(song $song, artist $artist)
        {
            $this->songService->deleteSong($song);
            $this->helper->redirect("artist-detail-page.php?id=$artist->id");
        }

        public function addSong(int $artistId) : void
        {
            $data = array(
                'title'=>$_POST['title'],
                'url'=>$_POST['url'],
                'image'=>$_FILES["image"]?? ''
            );

            $this->songService->addSong($data, $artistId);
            $this->helper->redirect("artist-detail-page.php?id=$artistId");
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
                $this->helper->refresh();
            } catch(Exception $e) {
                echo $e;
            }
        }
    }
?>