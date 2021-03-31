<?php
    class song {
        private int $id;
        private int $artistId;
        private string $title;
        private ?string $image;
        private string $url;
        
        public function __get(string $propName)
        {
            if(property_exists($this, $propName)) {
                return $this->$propName;
            }
        }

        public function __construct(int $id, int $artistId, ?string $image, string $title, string $url) {
            $this->id = $id;
            $this->artistId = $artistId;
            $this->image = $image;
            $this->title = $title;
            $this->url = $url;
        }

        public function mutateToArray()
        {
            return get_object_vars($this);
        }
    }
?>