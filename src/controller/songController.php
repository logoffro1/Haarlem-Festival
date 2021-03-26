<?php
    include '../classes/autoloader.php';

    class songController
    {
        private songService $songService;

        public function __construct() 
        {
            try
            {
                $this->songService = new songService();
            }
            catch(Exception $e)
            {
                throw ($e->getMessage());
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