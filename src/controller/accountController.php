<?php
    include '../classes/autoloader.php';

    class accountController extends controller
    {
        private accountService $accountService;
        private mailController $mailController;

        public function __construct() {
            parent::__construct();
            $this->accountService = new accountService();
            $this->mailController = new mailController();
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

                $this->mailController->sendMail(
                    $email, 
                    'Haarlem Festival User Activation',
                    "Click this link to activate your account. ". ROOT_URL . "cms/activate-account.php?email=" . $email . " <br/> or try " 
                    . ROOT_URL_PRODUCTION . "cms/activate-account.php?email=" . $email,
                    $name
                );

                // Redirect to login
                $this->helper->redirect("login.php");
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

        
        /*
        * Sent reset password, to email
        */
        public function sentResetPassword() : void
        {
            try {
                // Get user email input
                $email = htmlspecialchars($_POST["email"]);
    
                // $reciever,$subject,$content,$name, $pdf
                $this->mailController->sendMail(
                    $email, 
                    'Haarlem Festival - Password Reset',
                    'Click this link to reset your password. ' . ROOT_URL . "cms/reset-password.php?email=$email" . " <br/> or try " 
                    . ROOT_URL_PRODUCTION . "cms/reset-password.php?email=$email",
                    ""
                );

                // Create confirmation message
                $this->addToSuccess('We have sent a mail to your email address. Please follow the instructions provided in the mail.');
            } catch(Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        /*
        * Change password of user
        */
        public function changeAccountPassword() : void
        {
            try {
                // Check if email exist
                if(isset($_GET["email"])){
                    // Get email param, and user inputted password value
                    $password = $_POST["new_password"];
                    $email = $_GET["email"];
    
                    // Check if password is empty
                    if(empty($password)){
                        // Show error message
                        throw new Exception('Input field is not filled in');
                        return;
                    }
    
                    // Change user password in model
                    $this->accountService->changeUserPassword($email, $password);
    
                    // Show confirmation message
                    $this->addToSuccess('Password is updated, please try to login.');
                } else {
                    // Show error message
                    throw new Exception('Email is not present. Please check if the url is correct.');
                }
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        // Create user session value
        public function createUserSession(cmsUser $loggedInUser) : void
        {
            try {
                $this->helper->startSession();
                $_SESSION["loggedInUser"] = serialize($loggedInUser);
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        // Update user session values
        public function updateUserSession() : void
        {
            try {
                $this->helper->startSession();
                $user = $this->helper->getLoggedInUser();
    
                $email = $_POST['email'];
                $name = $_POST['name'];
    
                $user->setName($name);
                $user->setEmail($email);
    
                $_SESSION["loggedInUser"] = serialize($user);
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        public function getLoggedInUser() : ?cmsUser
        {
            try {
                return $this->helper->getLoggedInUser();
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }
        // Logout and clear session and cookies
        public function logout() : void
        {
            try {
                $this->helper->destroySession();
    
                // Clear all cookies
                $this->helper->clearCookies();
    
                $this->helper->redirect("login.php");
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }
    }

?>