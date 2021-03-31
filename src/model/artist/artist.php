<?php 
    class artist {
        private int $id;
        private string $name;
        private ?string $biography;
        private ?string $image;
        private ?string $thumbnail;
        private ?string $facebook;
        private ?string $instagram;
        private ?string $youtube;
        private ?array $songs;
        private ?array $performances;

        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }
        
        public function __construct(int $id, string $name, ?string $biography = null, ?string $image = null, ?string $thumbnail = null, ?string $facebook = null, ?string $instagram = null, ?string $youtube = null, ?array $songs = null, ?array $performances = null) {
            $this->id = $id;
            $this->name = $name;
            $this->biography = $biography;
            $this->image = $image;
            $this->thumbnail = $thumbnail ?? '';
            $this->facebook = $facebook;
            $this->instagram = $instagram;
            $this->youtube = $youtube;
            $this->songs = $songs;
            $this->performances = $performances;
        }
    }
?>
