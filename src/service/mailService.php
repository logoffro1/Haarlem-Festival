<?php
include '../classes/autoloader.php';
require __DIR__ . '/../vendor/autoload.php';

error_reporting(0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class mailService  {

	public function __construct() {
		$this->db = database::getInstance();
		$this->conn = $this->db->getConnection();
	}


	public function sendMail($emailData, $pdf = false) : void
	{
		$mail = new PHPMailer();
		try
		{
			/* Mail settings for sending mail */
			$mail->IsSMTP();  // telling the class to use SMTP
			$mail->SMTPSecure = 'tls';  
			$mail->Mailer = "smtp";
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 587;
			$mail->SMTPAuth = true; // turn on SMTP authentication
			$mail->Username = "thehaarlemfestival@gmail.com"; // SMTP username
			$mail->Password = "Thehaarlemfestival123"; // SMTP password
			$Mail->Priority = 1; 

			/* Mail content */
			//Recipients
			$mail->SetFrom("thehaarlemfestival@gmail.com", 'The Haarlem Festival');
			// Add a recipient
			$mail->AddAddress($emailData['reciever'], $emailData['name']);

			$mail->Subject  = $emailData['subject'];
			
			//Attachments
			if($pdf){
				$mail->AddStringAttachment($pdf,'Haarlem_Festival_Invoice.pdf','base64','application/pdf');
			}

			$mail->Body = $emailData['content'];

			//Content
			$mail->isHTML(true);
			$mail->send();
		}
		catch (Exception $e)
		{
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		};
	}
}

?>