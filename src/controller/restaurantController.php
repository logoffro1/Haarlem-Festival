  
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
            try {
                return $this->restaurantService->getRestaurants();
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        public function getRestaurant() : ?restaurant
        {
            try {
                if(isset($_GET['id'])){
                    return $this->restaurantService->getRestaurant($_GET['id']);
                }
    
                return null;
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        public function addRestaurant() : void
        {
            try {
                $data = [
                    'name'=>$_POST['name'],
                    'address'=>$_POST['address'],
                    'insert_cuisine'=>$_POST['restaurant_type'] ?? array(),
                    'biography'=>$_POST['biography'],
                    'duration'=>(int)$_POST['duration'],
                    'sessions'=>(int)$_POST['sessions'],
                    'start_of_session'=>$_POST['start_of_session'],
                    'seats'=>(int)$_POST['seats'],
                    'stars'=>(int)$_POST['stars'],
                    'price'=>floatval($_POST['price'])
                ];

    
                $this->restaurantService->addRestaurant($data, $this->pageId);
                $this->helper->redirect("cuisine-event.php");
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }        
        }

        public function addRestaurantImages(restaurant $restaurant) : void
        {
            try {
                // Get already present restaurant images
                $restaurantImages = $restaurant->images;
                // Create array to store new images
                $imageArray = array();

                // 3 images are needed for the restaurants, so we can hardloop over it
                for ($i=0; $i < 3; $i++) {
                    // Get image on number suffix, based on name attribute in the html
                    $image = $_FILES['image_'.$i];

                    // Check if an new image is present
                    if(strlen($image['name']) > 0){
                        // Add it to the array
                        $imageArray[] = $image['name'];
                        // Upload it to the database
                        $this->restaurantService->uploadImage($image);
                    // If no new image is uploaded, but a current image already exist
                    } else if(isset($restaurantImages[$i])){
                        // Add it to the array, no upload needed, because it is already present
                        $imageArray[] = $restaurantImages[$i];
                    }
                }

                // Create a string from the array, to upload to the database (database makes use of a string of images sperated by ',')
                $imageString = implode(',', $imageArray);

                // Send images and restaurant id
                $this->restaurantService->updateRestaurantImage($imageString, $restaurant->id);
                $this->helper->refresh();
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }  
        }

        public function deleteRestaurantImages(restaurant $restaurant)
        {
            try {
                $this->restaurantService->deleteRestaurantImages($restaurant);
                $this->restaurantService->updateRestaurantImage(null, $restaurant->id);
                $this->helper->refresh();
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

        public function deleteRestaurant(restaurant $restaurant)
        {
            try {
                $this->restaurantService->deleteRestaurant($restaurant);
                $this->helper->redirect("cuisine-event.php");
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }
    }
    
?>