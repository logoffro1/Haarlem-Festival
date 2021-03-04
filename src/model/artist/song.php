<?php
    class song {
        private int $id;
        private string $title;
        private string $image;
        private string $url;

        public function __construct(int $id, string $image, string $title, string $url) {
            $this->id = $id;
            $this->image = $image;
            $this->title = $title;
            $this->url = $url;
        }
    }
?>