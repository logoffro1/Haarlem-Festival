<?php
    class purchase {
        private int $purchaseId;
        private string $name;
        private string $email;
        private float $price;
        private float $discount;
        private bool $isPayed;
        private ?array $tickets;

        public function __get(string $propName)
        {
            if(property_exists($this, $propName)) {
                return $this->$propName;
            }
        }

        public function __construct(int $purchaseId, string $name, string $email, float $price, float $discount, bool $isPayed, ?array $tickets = null) {
            $this->purchaseId = $purchaseId;
            $this->name = $name;
            $this->email = $email;
            $this->price = $price;
            $this->discount = $discount;
            $this->isPayed = $isPayed;
            $this->tickets = $tickets;
        }

        public function mutateToArray()
        {
            return get_object_vars($this);
        }
    }
?>