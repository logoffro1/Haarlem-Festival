<?php
    include '../classes/autoloader.php';

    class accountController extends controller
    {
        private accountService $accountService;

        public function __construct() {
            parent::__construct();
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
                    'content' => "Click this link to activate your account. ". ROOT_URL . "cms/activate-account.php?email=" . $email . " <br/> or try " 
                    . ROOT_URL_PRODUCTION . "cms/activate-account.php?email=" . $email,
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

        
        /*
        * Sent reset password, to email
        */
        public function sentResetPassword() : void
        {
            try {
                // Get user email input
                $email = htmlspecialchars($_POST["email"]);
    
                // Create email data
                $emailData = [
                    'reciever' => $email,
                    'sender' => "From: " . EMAIL,
                    'subject' => 'Haarlem Festival - Password Reset',
                    'content' => 'Click this link to reset your password. ' . ROOT_URL . "cms/reset-password.php?email=$email" . " <br/> or try " 
                    . ROOT_URL_PRODUCTION . "cms/reset-password.php?email=$email",
                ];
    
                // Sent  email
                $this->sentMail($emailData);

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
            $this->helper->startSession();
            $_SESSION["loggedInUser"] = serialize($loggedInUser);
        }

        // Update user session values
        public function updateUserSession() : void
        {
            $this->helper->startSession();
            $user = $this->helper->getLoggedInUser();

            $email = $_POST['email'];
            $name = $_POST['name'];

            $user->setName($name);
            $user->setEmail($email);

            $_SESSION["loggedInUser"] = serialize($user);
        }

        public function getLoggedInUser() : ?cmsUser
        {
            return $this->helper->getLoggedInUser();
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