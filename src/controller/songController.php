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
            try {

                if(isset($_GET['event']))    
                {
                    $eventId = $_GET['event'];
                }
                $this->songService->deleteSong($song);
                $this->helper->redirect("artist-detail-page.php?id=$artist->id&event=$eventId");
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function addSong(int $artistId) : void
        {
            try {
                if(isset($_GET['event']))    
                {
                    $eventId = $_GET['event'];
                }
                $data = array(
                    'title'=>$_POST['title'],
                    'url'=>$_POST['url'],
                    'image'=>$_FILES["image"]?? ''
                );
    
                $this->songService->addSong($data, $artistId);
                $this->helper->redirect("artist-detail-page.php?id=$artistId&event=$eventId");
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function getSong() : ?song
        {
            try {
                if(isset($_GET["id"])){
                    $songId = $_GET["id"];
                    
                    return $this->songService->getSong($songId);
                }
    
                return null;
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
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
                $this->addToErrors($e->getMessage());
            }
        }

        public function deleteSongImage(song $song)
        {
            try {
                if(strlen($song->image) == 0){
                    throw new Exception("No image provided");
                }

                if($this->songService->deleteImage($song->image)){
                    $this->songService->deleteSongImage($song);
                    $this->helper->refresh();
                }
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function getSongsByArtistId(int $id)
        {
            try
            {
                return $this->songService->getSongsByArtistId($id);
            }
            catch(Exception $e)
            {
                throw ($e->getMessage());
            }
        }
    }
    
?>