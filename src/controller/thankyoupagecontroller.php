<?php
    include '../classes/autoloader.php';
    // Include once, because otherwise their will be an error, bcs the database.php also uses it and u get multiple defined variables.
    include_once '../config/config.php';
    require __DIR__ . '/../../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    class thankyoupagecontroller
    {
        private thankyoupageservice $thankyoupageService;

        public function __construct() {
            $this->thankyoupageService = new thankyoupageservice();
        }

        public function sendMail($reciever,$subject,$content,$name)
        {

            try {
                $data = array(
                    'reciever'=>$reciever,
                    'subject'=>$subject,
                    'content'=>$content,
                    'name'=>$name,
                    'sender'=>"from:".EMAIL,
                );

                $this->thankyoupageService->sendMail($data);
            } catch(Exception $e){
                echo $e;
            }
        }
        public function sendDataToDB($fname, $lname,$email){
            $this->thankyoupageService->sendDataToDB($fname,$lname,$email);
        }
    }

?>
