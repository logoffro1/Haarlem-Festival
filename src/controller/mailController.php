<?php
    include '../classes/autoloader.php';
    // Include once, because otherwise their will be an error, bcs the database.php also uses it and u get multiple defined variables.
    include_once '../config/config.php';
    require __DIR__ . '/../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    class mailController extends controller
    {
        private mailService $mailService;

        public function __construct() {
            parent::__construct();
            $this->mailService = new mailService();
        }

        public function sendMail($reciever,$subject,$content,$name, $pdf = false)
        {

            try {
                $data = array(
                    'reciever'=>$reciever,
                    'subject'=>$subject,
                    'content'=>$content,
                    'name'=>$name
                );

                $this->mailService->sendMail($data, $pdf);
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }
    }

?>
