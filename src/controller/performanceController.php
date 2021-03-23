<?php
    include '../classes/autoloader.php';

    class performanceController extends controller {
        private performanceService $performanceService;

        public function __construct() {
            parent::__construct();
            $this->performanceService = new performanceService();
        }

        public function addPerformance(artist $artist) : void
        {
            try {
                $data = [
                    'date'=>$_POST['date'],
                    'time'=>$_POST['start_time'],
                    'duration'=>$_POST['duration'],
                    'location'=>$_POST['location'],
                    'tickets'=>$_POST['tickets']
                ];
    
                $this->performanceService->addPerformance($artist, $data);
                $this->helper->redirect("artist-detail-page.php?id=$artist->id");
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function deletePerformance(artist $artist)
        {
            try {
                $id = $_GET['delete'];
    
                $this->performanceService->deletePerformance((int)$id);
                $this->helper->redirect("artist-detail-page.php?id=$artist->id");
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        public function getPerformance()
        {
            try {
                if(isset($_GET['id'])){
                    $id = (int)$_GET['id'];
    
                    return $this->performanceService->getPerformance($id);
                }
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function updatePerformance()
        {
            try {
                $id = $_GET['id'];
    
                $data = [
                    'date'=>$_POST['date'],
                    'time'=>$_POST['start_time'],
                    'duration'=>$_POST['duration'],
                    'location'=>$_POST['location']
                ];
    
                $this->performanceService->updatePerformance($data, $id);
                $this->helper->refresh();
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }
    }
?>