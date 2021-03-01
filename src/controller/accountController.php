<?php
    include '../classes/autoloader.php';

    class accountController
    {
        private accountService $accountService;
        private helper $helper;

        public function __construct() {
            $this->helper = new helper();
            $this->accountService = new accountService();
        }

        public function login()
        {
            try {
                // Get user input data
                $username = $_POST["username"];
                $password = $_POST["password"];
                
                // Check if none or password is empty, show an error
                if(empty($username) || empty($password)){
                    throw new Exception('Input field(s) is/are not filled in');

                    return;
                }
    
                // Get user from database (password check is in the called model method)
                $loggedInUser = $this->userModel->getUserByCredentials($username, $password);
    
                // If user does not exist show error message and stop the method
                if($loggedInUser == null){
                    throw new Exception('Login credentials are incorrect');
                    return;
                }
    
                // Create user session and redirect to dashboard page
                $this->createUserSession($loggedInUser);
                $this->helpers->redirect("cms/");

                exit();
            } catch (Exception $e){
                // Todo add catch method to display error messages
            }
        }

        // Create user session value
        private function createUserSession(cmsUser $loggedInUser) : void
        {
            $this->helpers->startSession();
            $_SESSION["loggedInUser"] = serialize($loggedInUser);
        }

        // Logout and clear session and cookies
        public function logout() : void
        {
            session_unset();
            session_destroy();

            // Clear all cookies
            if(isset($_POST['remove_cookies'])){
                $past = time() - 3600;
                foreach ( $_COOKIE as $key => $value )
                {
                    setcookie( $key, $value, $past, '/' );
                }
            }

            $this->helpers->redirect("index.php");
        }
    }

?>