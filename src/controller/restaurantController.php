  
<?php
    include '../classes/autoloader.php';

    class restaurantController extends controller
    {
        private restaurantService $restaurantService;
        private int $pageId = 1;
        
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

        public function addRestaurant() : void
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
    
                $this->restaurantService->addRestaurant($data ,$this->pageId);
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }        
        }

        public function addRestaurantImage() : void
        {
            try {    
                $this->restaurantService->addRestaurantImage($_FILES);
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }  
        }

        public function updateRestaurant(restaurant $restaurant) : void
        {
            try {
                // Get id's of the 'NEW' selected cuisine types of the restaurant.
                $cuisinePostValues = $_POST['restaurant_type'];

                // Get id's of the 'OLD' selected cuisine types of the restaurant.
                $originalCuisineId = array();
                foreach ($restaurant->cuisines as $cuisine) {
                    $originalCuisineId[] = $cuisine->id;
                };

                $data = [
                    'name'=>$_POST['name'],
                    'address'=>$_POST['address'],
                    'delete_cuisines'=>implode(',', array_diff($originalCuisineId, $cuisinePostValues)), // Check which cuisine types got REMOVED and implode it, so it can be used in the WHERE IN mysql clause
                    'insert_cuisines'=>array_map('intval', array_diff($cuisinePostValues, $originalCuisineId)), // Check which cuisine types got ADDED
                    'biography'=>$_POST['biography'],
                    'duration'=>$_POST['duration'],
                    'sessions'=>$_POST['sessions'],
                    'start_of_session'=>$_POST['start_of_session'],
                    'seats'=>$_POST['seats'],
                    'stars'=>$_POST['stars'],
                    'price'=>$_POST['price']
                ];

                $this->restaurantService->updateRestaurant($restaurant, $data);
                $this->helper->refresh();
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }
    }
    
?>