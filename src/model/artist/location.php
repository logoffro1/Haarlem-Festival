<?php
    class location {
        private int $id;
        private string $name;
        private string $address;
        private string $hallName;
        private int $seats;
        private double $price;
        
        public function __construct(int $id, string $name, string $address, string $hallName, int $seats, double $price) {
            $this->id = $id;
            $this->name = $name;
            $this->address = $address;
            $this->hallName = $hallName;
            $this->seats = $seats;
            $this->price = $price;
        }
    }
?>