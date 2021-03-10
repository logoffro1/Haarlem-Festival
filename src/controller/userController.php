<?php
    include '../classes/autoloader.php';

    class userController extends controller {
        private userService $userService;
        private helper $helper;

        public function __construct() {
            parent::__construct();

            $this->helper = new helper();
            $this->userService = new userService();
        }

        public function getUsers() : ?array
        {
            try {
                return $this->userService->getUsers();
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function getUser() : ?cmsUser
        {
            try {
                $userId = $_GET['id'];
    
                return $this->userService->getUser($userId);
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function updateUser() : void
        {
            try {
                $email = htmlspecialchars($_POST['email']);
                $name = htmlspecialchars($_POST['name']);
                $id = htmlspecialchars($_GET['name']);
    
                $this->userSerice->updateUser($email, $name, $id);
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }
    }
?>