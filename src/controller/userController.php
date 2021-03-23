<?php
    include '../classes/autoloader.php';

    class userController extends controller {
        private userService $userService;

        public function __construct() {
            parent::__construct();

            $this->userService = new userService();
        }

        public function getUsers() : ?array
        {
            try {
                $user = $this->helper->getLoggedInUser();
                return $this->userService->getUsers($user);
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

        
        public function deleteUser() : void
        {
            try {
                $userId = $_GET['id'];
    
                $this->userService->deleteUser($userId);
                $this->helper->redirect("user-page.php");
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function updateUser(int $id = null) : void
        {
            try {
                $email = $_POST['email'];
                $name = $_POST['name'];
                $id = $id ?? $_GET['id'];

                $this->userService->updateUser($email, $name, $id);
                $this->helper->refresh();
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }
    }
?>