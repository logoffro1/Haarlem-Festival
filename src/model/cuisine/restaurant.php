<?php
class restaurant {
    private int $id;
    private string $name;
    private array $cuisines;
    private string $address;
    private ?string $biography;
    private array $images;
    private float $duration;
    private int $sessions;
    private string $startOfSession;
    private int $seats;
    private int $stars;
    private float $price;

    public function __construct(int $id, string $name, array $cuisines, string $address, ?string $biography = "", array $images = array(), float $duration, int $sessions, string $startOfSession, int $seats, int $stars, float $price){
        $this->id = $id;
        $this->name = $name;
        $this->cuisines = $cuisines;
        $this->address = $address;
        $this->biography = $biography;
        $this->images = $images;
        $this->duration = $duration; 
        $this->sessions = $sessions;
        $this->startOfSession = $startOfSession;
        $this->seats = $seats;
        $this->stars = $stars;
        $this->price = $price;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function getSessions(){
        
        $sessions = array();
        $sessionStart = null;

        for($x = 0; $x<$this->sessions;$x++){
            $sessionStart = $sessionStart == null ? date("H:i",strtotime($this->startOfSession)) : date("H:i",strtotime($sessionEnd));
            $sessionEnd = date("H:i",strtotime($sessionStart)+$this->getDurationInSeconds());
            $sessions[$x] = ($sessionStart)."-".($sessionEnd);
        }
        
        return $sessions;
    }

    private function getDurationInSeconds(){
        return ($this->duration / 1) * 3600 + ($this->duration % 1) * 60;
    }

    //check if the restaurant contains the cuisine
    public function hasCuisine(string $cuisinesString){
        $cuisines = explode(";",$cuisinesString);

        foreach ($this->cuisines as $cuisine) {
            if(in_array($cuisine->__get('name'),$cuisines))
            return true;
        }
        return false;
    }

    public function mutateToArray()
    {
        return get_object_vars($this);
    }
}

?>