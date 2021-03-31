<?php 
    class tour {
        private int $id;
        private string $date;
        private string $time;
        private float $price;
        private float $family_price;
        private int $seats;
        private ?array $tourTypes;
        
        public function __construct(int $id, string $date, string $time, float $price, float $family_price, int $seats, array $tourTypes = null) {
            $this->id = $id;
            $this->date = $date;
            $this->time =$time;
            $this->price =$price;
            $this->family_price =$family_price;
            $this->seats = $seats;
            $this->tourTypes = $tourTypes;
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }
    }
?>