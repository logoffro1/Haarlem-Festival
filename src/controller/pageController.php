<?php
    include '../classes/autoloader.php';

    class pageController extends controller {
        private pageService $pageService;

        public function __construct() {
            $this->pageService = new pageService();
        }

        public function updatePage(int $id) : void
        {
            try {
                $data = json_encode($_POST);

                $this->pageService->updatePage($data, $id);
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }   
        }

        public function getPage(int $id) : void
        {
            try {
                $this->pageService->getPage($id);
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }   
        }
    }
?>