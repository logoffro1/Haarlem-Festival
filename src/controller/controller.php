<?php
include_once '../config/config.php';
include_once '../classes/helper.php';

    class controller {
        protected array $errors;
        protected array $success;
        protected helper $helper;

        public function __construct() {            
            $this->helper = new helper();

            $this->errors = array();
            $this->success = array();

            $this->checkIfLoggedIn();
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }

        protected function addToErrors(string $error)
        {
            $this->errors[] = $error;
        }

        protected function removeErrors(){
            unset($errors);
        }

        protected function addToSuccess(string $success)
        {
            $this->success[] = $success;
        }

        protected function removeSuccess(){
            unset($success);
        }

        /**
         * checkIfLoggedIn - check if user is logged in with sessions,
         * if not redirect to login page, if user is already on the login page,
         * or is not on the cms flow or the stated pages, stop the check
         * to avoid infinite redirects.
         */
        protected function checkIfLoggedIn(){
            try {
                $this->helper->startSession();
                $url = $_SERVER['REQUEST_URI'];
    
                if (
                    strpos($url, "login.php") || 
                    strpos($url, "reset-password.php") || 
                    strpos($url, "activate-account.php") || 
                    strpos($url, "register.php") || 
                    !strpos($url, "cms")
                ){
                    return;
                }
    
                if(!isset($_SESSION['loggedInUser'])){
                    $this->helper->redirect('login.php');
                }
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }
    }
?>