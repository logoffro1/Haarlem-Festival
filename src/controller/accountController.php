<?php
    include '../classes/autoloader.php';

    class accountController extends controller
    {
        private accountService $accountService;
        private helper $helper;

        public function __construct() {
            parent::__construct();
            $this->helper = new helper();
            $this->accountService = new accountService();
        }

        public function login()
        {
            try {
                // Get user input data
                $email = $_POST["email"];
                $password = $_POST["password"];
                
                // Check if none or password is empty, show an error
                if(empty($email) || empty($password)){
                    throw new Exception('Input field(s) is/are not filled in');

                    return;
                }
    
                // Get user from database (password check is in the called model method)
                $loggedInUser = $this->accountService->getAccountByCredentials($email, $password);
    
                // If user does not exist show error message and stop the method
                if($loggedInUser == null){
                    throw new Exception('Login credentials are incorrect');
                    return;
                }
    
                // Create user session and redirect to dashboard page
                $this->createUserSession($loggedInUser);
                $this->helper->redirect("index.php");

                exit();
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        /*
        * Register user
        */
        public function register() : void
        {           
            // Add user to database.
            try {
                $name = $_POST["fullname"];
                $email = $_POST["email"];
                $password = $_POST["password"];

                // Check if email already exist in database
                if($this->accountService->getUsersCountByEmail($email) > 0){
                    throw new Exception('Account with these credentials already exist');
                    return;
                }
                
                // Create user class with values
                $user = new cmsUser(
                    0,
                    $name,
                    $email,
                    $this->helper->encryptPassword($password),
                );

                // Add user to the database via the model layer
                $this->accountService->addUser($user);

                // Create email template
                $mailData = [
                    'reciever' => "$email",
                    'subject' => 'Haarlem Festival User Activation',
                    'content' => "Click this link to activate your account. ". ROOT_URL . "cms/activateAccount.php?email=" . $email . " <br/> or try " 
                    . ROOT_URL_PRODUCTION . "cms/activateAccount.php?email=" . $email,
                    'sender' => 'From: ' . EMAIL,
                ];
        
                // Sent email
                $this->sentMail($mailData);

                // Redirect to login
                // $this->helper->redirect("login.php");
            } catch(Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        /*
        * Activate account based on url from email
        */
        public function activateAccount() : bool
        {
            try {
                // Get email from url
                $email = htmlspecialchars($_GET['email'] ?? "");

                // Check if empty
                if(empty($email)){
                    // Throw a new error with message
                    throw new Exception("No email provided. Please check if the url is correct");
                }
    
                // Activate acount via model layer
                $this->accountService->activateAccount($email);

                return true;
            } catch(Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
                return false;
            }
        }

        // Create user session value
        private function createUserSession(cmsUser $loggedInUser) : void
        {
            $this->helper->startSession();
            $_SESSION["loggedInUser"] = serialize($loggedInUser);
        }

        // Logout and clear session and cookies
        public function logout() : void
        {
            $this->helper->destroySession();

            // Clear all cookies
            $this->helper->clearCookies();

            $this->helper->redirect("login.php");
        }
    }

?>