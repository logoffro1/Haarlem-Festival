<?php
    class performance {
        private int $id;
        private string $date;
        private string $time;
        private location $location;
        private int $tickets;
        private int $duration;

        public function __get(string $propName)
        {
            if(property_exists($this, $propName)) {
                return $this->$propName;
            }
        }

        public function __construct(int $id, string $date, string $time, int $duration, int $tickets, location $location) {
            $this->id = $id;
            $this->date = $date;
            $this->time = $time;
            $this->duration = $duration;
            $this->tickets = $tickets;
            $this->location = $location;
        }

        public function mutateToArray()
        {
            return get_object_vars($this);
        }
    }
?>