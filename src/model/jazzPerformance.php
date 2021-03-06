<?php 
class jazzPerformance{

    private int $performanceID;
    private jazzArtist $artist;
    private location $location;
    private string $performanceDate;
    private string $performanceTime;
    private int $duration;
    private int $availableTickets;

    public function __construct(int $performanceID, jazzArtist $artist, location $location, string $performanceDate, string $performanceTime, int $duration, int $availableTickets)
    {
        $this->performanceID = $performanceID;
        $this->artist = $artist;
        $this->location = $location;
        $this->performanceDate = $performanceDate;
        $this->performanceTime = $performanceTime;
        $this->duration = $duration;
        $this->availableTickets = $availableTickets;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function getArtistName(){return $this->artist->getName();}
    public function getDate(){return date("d M",strtotime($this->performanceDate));}
    public function getTime(){return $this->performanceTime;}
    public function getLocation(){return $this->location->getName();}
}

?>