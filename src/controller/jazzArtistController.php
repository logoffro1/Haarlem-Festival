<?php
    include '../classes/autoloader.php';

    class jazzArtistController
    {
        private jazzArtistService $jazzArtistService;

        public function __construct() {
            try
            {
               $this->jazzArtistService = new jazzArtistService();
            }
            catch(Exception $e)
            {
                throw ($e->getMessage());
            } 
        }

        public function getAJazzArtistById(int $id)
        {
            try
            {
                return $this->jazzArtistService->getAJazzArtistById($id);
            }
            catch(Exception $e)
            {
                throw ($e->getMessage());
            }
        }

        public function getAllJazzArtists()
        {
            try
            {
                return $this->jazzArtistService->getAllJazzArtists();
            }
            catch(Exception $e)
            {
                throw ($e->getMessage());
            }    
        }
    }
    
?>