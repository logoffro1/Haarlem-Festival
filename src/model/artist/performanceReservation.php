<?php
    include '../classes/autoloader.php';

    class performanceReservation {
        private int $reservation_performance_id;
        private performance $performance;
        private int $purchase_id;
        private int $seats;

        
        public function __get(string $propName)
        {
            if(property_exists($this, $propName)) {
                return $this->$propName;
            }
        }

        public function __construct(int $reservation_performance_id, performance $performance_id, int $purchase_id, int $seats) {
            $this->reservation_performance_id = $reservation_performance_id;
            $this->performance = $performance;
            $this->purchase_id = $purchase_id;
            $this->seats = $seats;
        }
    }
?>