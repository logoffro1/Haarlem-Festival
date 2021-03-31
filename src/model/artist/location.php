<?php
    class location {
        private int $id;
        private string $name;
        private string $address;
        private int $seats;
        private float $price;

        public function __get(string $propName)
        {
            if(property_exists($this, $propName)) {
                return $this->$propName;
            }
        }

        public function __construct(int $id, string $name, string $address, int $seats, float $price) {
            $this->id = $id;
            $this->name = $name;
            $this->address = $address;
            $this->seats = $seats;
            $this->price = $price;
        }

        public function mutateToArray()
        {
            return get_object_vars($this);
        }

    }
?>