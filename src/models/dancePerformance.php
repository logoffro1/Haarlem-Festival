<?php
class dancePerformance{

    private int $performanceID;
    private location $location;
    private string $performanceDate;
    private string $performanceTime;
    private int $duration;
    private int $availableTickets;

    public function __construct(int $performanceID, location $location, string $performanceDate, string $performanceTime, int $duration, int $availableTickets)
    {
        $this->performanceID = $performanceID;
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
    public function getPrice(){return $this->location->__get('price');}
    public function getDayOfWeek(){return date("l",strtotime($this->performanceDate));}
    public function getDate(){return date("d M",strtotime($this->performanceDate));}
    public function getTime()
    {
        $startTime = date("H:i",strtotime($this->performanceTime));
        $endTime = date("H:i",strtotime($this->performanceTime) + $this->duration * 3600);

        return ($startTime." - ".$endTime);
    }
    public function getLocation(){return $this->location->__get('name');}
}

?>