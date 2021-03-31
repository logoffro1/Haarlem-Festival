<?php
    class jazzIntro
    {
        private string $title;
        private string $img;
    
        public function __construct(string $title, string $img)
        {
            $this->title = $title;
            $this->img = $img;
        }
    
        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }
    public function render()
    {
        echo "
        <h1 class='title title--page jazz'>$this->title</h1>
        <img class='hero' src='$this->img'>
        ";
    }
}

?>