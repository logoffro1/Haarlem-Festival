<?php 
    class jazzArtist {
        private int $id;
        private string $name;
        private string $biography;
        private string $image;
        private string $facebook;
        private string $instagram;
        private string $youtube;
        private array $songs;

        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }
        
        public function __construct(int $id, string $name, string $biography = null, string $image = null, string $facebook = null, string $instagram = null, string $youtube = null,array $songs = null) {
            $this->id = $id;
            $this->name = $name;
            $this->biography = $biography;
            $this->image = $image;
            $this->facebook = $facebook;
            $this->instagram = $instagram;
            $this->youtube = $youtube;
            $this->songs = $songs;
        }

        public function getName(){return $this->name;}
    }
?>