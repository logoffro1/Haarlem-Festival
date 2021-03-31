<?php
class song{
    private int $songID;
    private int $artistID;
    private string $title;
    private string $image;
    private string $url;

    public function __construct(int $songID, int $artistID, string $title, string $image, string $url)
    {
        $this->songID = $songID;
        $this->artistID = $artistID;
        $this->title = $title;
        $this->image = $image;
        $this->url = $url;
    }
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}
?>