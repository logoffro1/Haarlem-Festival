<?php
    class songController {
        private songService $songService;
        private helper $helper;

        public function __construct() {
            $this->helper = new helper();
            $this->songService = new songService();
        }


        public function addSong() : void
        {
            $this->artistService->addSong();
        }
    }
?>