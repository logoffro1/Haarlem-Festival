<?php
    include '../classes/autoloader.php';

    class restaurantTypeController extends controller
    {
        private restaurantTypeService $restaurantTypeService;

        public function __construct() {
            parent::__construct();
            $this->restaurantTypeService = new restaurantTypeService();
        }

        public function getRestaurantTypes(){
            try {
                return $this->restaurantTypeService->getRestaurantTypes();
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        public function getTypeById(int $id){
            try {
                return $this->restaurantTypeService->getTypeById($id);
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
            $this->restaurantTypeService = new restaurantTypeService();
        }    
    }
    
?>