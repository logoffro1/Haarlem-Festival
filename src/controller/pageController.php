<?php
    include '../classes/autoloader.php';

    class pageController extends controller {
        private pageService $pageService;

        public function __construct() {
            parent::__construct();
            $this->pageService = new pageService();
        }

        /**
         * Create encoded json object, combined with the uploaded images names to update the content of the pages
         * 
         * @param int $id - id of page
         */
        public function updatePage(int $id) : void
        {
            try {
                // remove submit valuye from post
                unset($_POST['submit']);
                
                // Pass image names from html name attr as key, and image name from file as value
                foreach ($_FILES as $file => $value) {
                    $_POST[$file] = $value['name'];
                }
                
                $data = json_encode($_POST);

                $this->pageService->updatePage($data, $_FILES, $id);
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