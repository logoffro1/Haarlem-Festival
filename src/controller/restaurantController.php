<?php
    include '../classes/autoloader.php';

    class restaurantController
    {
        private restaurantService $restaurantService;

        public function __construct() {
            $this->restaurantService = new restaurantService();
        }    
        public function getRestaurants()
        {
            return $this->restaurantService->getRestaurants();
        }
        public function getRestaurantById(int $id){
            return $this->restaurantService->getRestaurantById($id);
        }
    }
    
?>