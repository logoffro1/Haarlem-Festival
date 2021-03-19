<?php
    include '../classes/autoloader.php';

    class tourController extends controller
    {
        private tourService $tourService;

        public function __construct() {
            parent::__construct();
            $this->tourService = new tourService();
        }

        public function getAllTours() : array
        {
            try {
                return $this->tourService->getAllTours();
            } catch(Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function getTourByID(int $id) : ?tour
        {
            try {
                $tour = $this->tourService->getTourByID($id);

                if($tour == null && strpos($_SERVER['REQUEST_URI'], "cms")){
                    $this->helper->redirect("history-event.php");
                }

                return $tour;
            } catch(Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function addTour()
        {
            try {
                $data = array(
                    'page_id' => 3,
                    'date' => $_POST['date'],
                    'time' => $_POST['time'],
                    'price' => (float)$_POST['price'],
                    'family_price' => (float)$_POST['family_price'],
                    'seats' => (int)$_POST['seats']
                );

                $this->tourService->addTour($data);
                // $this->helper->redirect("history-event.php");
            } catch(Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }
        public function updateTour(tour $tour)
        {
            try {
                $data = array(
                    'date' => $_POST['date'],
                    'time' => $_POST['time'],
                    'price' => $_POST['price'],
                    'family_price' => $_POST['family_price'],
                    'seats' => $_POST['seats']
                );

                $this->tourService->updateTour($data, $tour);
                $this->helper->refresh();
            } catch(Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function addTourType(tour $tour) : void
        {
            try {
                // Associative array for values needed in service layer
                $data = array();
                
                // Language of tour type needs to be retrieved to remove multiple (now redundant) $_POST checks in the tour-detail-page.php
                $activeLanguage = $this->getLanguage();

                // Get amount of seats
                $data['number_of_tours'] = (int)$_POST['number_of_tours'];
                
                $data['language'] = $activeLanguage;

                $this->tourService->addTourType($data, $tour);
                $this->helper->refresh();
            } catch(Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        /**
         * updateTourType - updates value of tours for specific language
         * 
         * @param tour $tour - active tour on page
         */
        public function updateTourType(tour $tour) : void
        {
            try {
                // Associative array for values needed in service layer
                $data = array();
                
                // Language of tour type needs to be retrieved to remove multiple (now redundant) $_POST checks in the tour-detail-page.php
                $activeLanguage = $this->getLanguage();

                // Get amount of seats
                $data['number_of_tours'] = (int)$_POST['number_of_tours'];

                // Get correct 'tourType' class from tourType array equal to the activeLanguage
                foreach ($tour->tourTypes as $type) {
                    if($type->language == $activeLanguage){
                        $data['tourTypeId'] = $type->tour_type_id;
                        break;
                    }
                }

                $this->tourService->updateTourType($data);
                $this->helper->refresh();
            } catch(Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function getLanguage() : string
        {
            // Language of tour type needs to be retrieved to remove multiple (now redundant) $_POST checks in the tour-detail-page.php
            $activeLanguage;
            
            // If statement needed, becuase ternary operator is left-associative,
            // so wrong value will be returned, even though the correct check passes.
            // Check for more info: https://stitcher.io/blog/shorthand-comparisons-in-php "Chaining ternary operators"
            if(isset($_POST['update_english']) || isset($_POST['add_english'])){
                $activeLanguage = "English";
            } else if(isset($_POST['update_dutch']) || isset($_POST['add_dutch'])){
                $activeLanguage = "Dutch";
            } else if(isset($_POST['update_chinese']) || isset($_POST['add_chinese'])){
                $activeLanguage = "Chinese";
            } else {
                throw new Exception("Cannot retrieve the correct language");
            }

            return $activeLanguage;
        }
    }
    
?>