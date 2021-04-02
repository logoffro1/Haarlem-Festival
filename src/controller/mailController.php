<?php
    include '../classes/autoloader.php';
    // Include once, because otherwise their will be an error, bcs the database.php also uses it and u get multiple defined variables.
    include_once '../config/config.php';
    require __DIR__ . '/../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    class mailController
    {
        private mailService $mailService;

        public function __construct() {
            $this->mailService = new mailService();
        }

        public function sendMail($reciever,$subject,$content,$name, $pdf)
        {

            try {
                $data = array(
                    'reciever'=>$reciever,
                    'subject'=>$subject,
                    'content'=>$content,
                    'name'=>$name,
                    'sender'=>"from:".EMAIL,
                );

                $this->mailService->sendMail($data, $pdf);
            } catch(Exception $e){
                echo $e;
            }
        }
        public function sendDataToDB($fname, $lname,$email){
            $this->thankyoupageService->sendDataToDB($fname,$lname,$email);
        }
    }

?>
