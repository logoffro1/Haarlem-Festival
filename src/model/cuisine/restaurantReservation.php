<?php
    class restaurantReservation {
        private int $reservation_cuisine_id;
        private restaurant $restaurant;
        private int $purchase_id;
        private int $seats;
        private int $sessionNr;
        private string $extra_info;

        public function __construct(int $reservation_cuisine_id, restaurant $restaurant, int $purchase_id, int $seats, int $sessionNr, string $extra_info) {
            $this->reservation_cuisine_id = $reservation_cuisine_id;
            $this->restaurant = $restaurant;
            $this->purchase_id = $purchase_id;
            $this->seats = $seats;
            $this->sessionNr = $sessionNr;
            $this->extra_info = $extra_info;
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }    
    }
?>