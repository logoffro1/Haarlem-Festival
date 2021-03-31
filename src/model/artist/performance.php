<?php
    class performance {
        private int $id;
        private string $date;
        private string $time;
        private location $location;
        private int $tickets;
        private int $duration;
        private int $artistID;

        public function __get(string $propName)
        {
            if(property_exists($this, $propName)) {
                return $this->$propName;
            }
        }

        public function __construct(int $id, string $date, string $time, int $duration, int $tickets, location $location, int $artistID) {
            $this->id = $id;
            $this->date = $date;
            $this->time = $time;
            $this->duration = $duration;
            $this->tickets = $tickets;
            $this->location = $location;
            $this->artistID = $artistID;
        }

        public function mutateToArray()
        {
            return get_object_vars($this);
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