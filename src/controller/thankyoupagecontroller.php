<?php
    include '../classes/autoloader.php';
    // Include once, because otherwise their will be an error, bcs the database.php also uses it and u get multiple defined variables.
    include_once '../config/config.php';

    class thankyoupagecontroller
    {
        private thankyoupageservice $thankyoupageService;

        public function __construct() {
            $this->thankyoupageService = new thankyoupageservice();
        }

        public function sendMail($reciever,$subject,$content)
        {
            try {
                $data = array(
                    'reciever'=>$reciever,
                    'subject'=>$subject,
                    'content'=>$content,
                    'sender'=>"from:".EMAIL // EMAIL is a global variable in the config file
                );

                // Will give a warning when commented out, because their is no email in the reciever
                // Also crash.txt can be made in the project root, please do not commit them.

                $this->thankyoupageService->sendMail($data);
            } catch(Exception $e){
                echo $e; // Error will just get shown on the page, error handling is for later
            }
        }

    }

?>