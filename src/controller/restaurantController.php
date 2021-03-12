  
<?php
    include '../classes/autoloader.php';

    class restaurantController extends controller
    {
        private restaurantService $restaurantService;

        public function __construct() {
            parent::__construct();
            $this->restaurantService = new restaurantService();
        }

        public function getRestaurants()
        {
            return $this->restaurantService->getRestaurants();
        }

        public function getRestaurant() : ?restaurant
        {
            if(isset($_GET['id'])){
                return $this->restaurantService->getRestaurant($_GET['id']);
            }

            return null;
        }

        public function updateRestaurant(restaurant $restaurant) : void
        {
            try {
                $data = [
                    'name'=>$_POST['name'],
                    'address'=>$_POST['address'],
                    'biography'=>$_POST['biography'],
                    'duration'=>$_POST['duration'],
                    'sessions'=>$_POST['sessions'],
                    'start_of_session'=>$_POST['start_of_session'],
                    'seats'=>$_POST['seats'],
                    'stars'=>$_POST['stars'],
                    'price'=>$_POST['price']
                ];
    
                $this->restaurantService->updateRestaurant($restaurant, $data);
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }
    }
    
?>