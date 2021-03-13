<?php
    include '../classes/autoloader.php';

    class pageController extends controller {
        private pageService $pageService;

        public function __construct() {
            parent::__construct();
            $this->pageService = new pageService();
        }

        public function updatePage(int $id) : void
        {
            try {
                unset($_POST['submit']);
                $data = json_encode($_POST);
                $this->pageService->updatePage($data, $id);
                $this->helper->refresh();
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }   
        }

        public function getPage(int $id) : ?object
        {
            try {
                $page =  $this->pageService->getPage($id);
                return json_decode($page->content);
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }   
        }
    }
?>