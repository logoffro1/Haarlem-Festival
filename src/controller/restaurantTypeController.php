<?php
    include '../classes/autoloader.php';

    class restaurantTypeController
    {
        private restaurantTypeService $restaurantTypeService;

        public function __construct() {
            $this->restaurantTypeService = new restaurantTypeService();
        }

        public function getRestaurantTypes(){
            return $this->restaurantTypeService->getRestaurantTypes();
        }

        public function getTypeById(int $id){
            return $this->restaurantTypeService->getTypeById($id);
        }
    }
    
?>