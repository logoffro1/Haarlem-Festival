<?php
    class tourType {
        private int $tour_id;
        private int $tour_type_id;
        private int $tour_guide_id;
        private int $amountOfTours;
        private string $language;

        public function __construct(int $tour_id, int $tour_type_id, int $tour_guide_id, int $amountOfTours, string $language) {
            $this->tour_id = $tour_id;
            $this->tour_type_id = $tour_type_id;
            $this->tour_guide_id = $tour_guide_id;
            $this->amountOfTours = $amountOfTours;
            $this->language = $language;
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }
    }
?>