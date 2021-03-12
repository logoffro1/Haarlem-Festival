  
<?php
    include '../classes/autoloader.php';

    class restaurantController extends controller
    {
        private restaurantService $restaurantService;

        public function __construct() {
            $this->restaurantService = new restaurantService();
        }
        
        public function getRestaurants()
        {
            return $this->restaurantService->getRestaurants();
        }
    }
    
?>