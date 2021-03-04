<?php
    class performance {
        private int $id;
        private date $date;
        private time $time;
        private string $type;
        private int $duration;
        private int $tickets;
        private location $location;

        public function __construct(int $id, date $date, time $time, string $type, int $duration, int $tickets, location $location) {
            $this->id = $id;
            $this->date = $date;
            $this->time = $time;
            $this->type = $type;
            $this->duration = $duration;
            $this->tickets = $tickets;
            $this->location = $location;
        }
    }
?>