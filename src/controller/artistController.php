<?php
    include '../classes/autoloader.php';

    class artistController extends controller {
        private artistService $artistService;

        public function __construct() {
            parent::__construct();
            $this->artistService = new artistService();
        }

        public function getJazzArtistList() : array
        {
            try {
                return $this->artistService->getArtistList(4); // Todo change id to correct jazz page id in database
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }
    
        public function getDanceArtistList() : array
        {
            try {
                return $this->artistService->getArtistList(2); // Todo change id to correct jazz page id in database
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function getArtist() : artist {
            try {
                $artistId = $_GET["id"];
    
                return $this->artistService->getArtist($artistId);
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function addArtist() : void {
            try {
                $data = [
                    'page_id' => (int)$_GET['event'],
                    'title' => $_POST['title'],
                    'page_content' => $_POST['page_content']
                ];

                $this->artistService->addArtist($data);

                if($data['page_id'] == 4){
                    $this->helper->redirect("jazz-event.php");
                } else {
                    $this->helper->redirect("dance-event.php");
                }
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function deleteArtist() : void {
            try {
                $artistId = (int)$_GET['delete'];

                $this->artistService->deleteArtist($artistId);
                $this->helper->redirect("index.php");
                
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function updateArtist(artist $artist) : void
        {
            try {
                $data = [
                    'title' => $_POST['title'] ?? NULL,
                    'page_content' => $_POST['page_content'] ?? NULL,
                    'youtube' => $_POST['youtube'] ?? NULL,
                    'instagram' => $_POST['instagram'] ?? NULL,
                    'facebook' => $_POST['facebook'] ?? NULL
                ];
    
                $this->artistService->updateArtist($artist, $data);
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function updateArtistImage(artist $artist) : void
        {
            try {
                $data = array(
                    'image'=>$_FILES["artist_image"]
                );
    
                $this->artistService->uploadImage($data);
                $this->artistService->updateArtistImage($artist, $data);
                $this->helper->refresh();
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function deleteArtistImage(artist $artist) : void
        {
            try {
                $data = array(
                    'image'=>null
                );
    
                if(empty($artist->image)){
                    throw new Exception("No image provided");
                }

                if($this->artistService->deleteImage($artist->image)){
                    $this->artistService->updateArtistImage($artist, $data);
                    $this->helper->refresh();
                }
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function createSession(artist $artist) : void
        {
            try {
                $this->helper->startSession();
                
                $_SESSION["artist"] = serialize($artist);
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }
        
        public function getSession() : ?artist
        {
            try {
                $this->helper->startSession();
    
                if(isset($_SESSION['artist'])){
                    return unserialize($_SESSION["artist"]);
                }
    
                return null;
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }
    }
?>