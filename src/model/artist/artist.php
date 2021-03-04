<?php 
    class artist {
        private int $id;
        private string $name;
        private ?string $biography;
        private ?string $image;
        private ?string $facebook;
        private ?string $instagram;
        private ?string $youtube;
        private ?array $songs;
        private ?array $performances;

        public function __construct(int $id, string $name, ?string $biography, ?string $image, ?string $facebook, ?string $instagram, ?string $youtube, ?array $songs = null, ?array $performances = null) {
            $this->id = $id;
            $this->name = $name;
            $this->biography = $biography;
            $this->image = $image;
            $this->facebook = $facebook;
            $this->instagram = $instagram;
            $this->youtube = $youtube;
            $this->songs = $songs;
            $this->performances = $performances;
        }
    }
?>
