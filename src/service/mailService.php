<?php

include '../classes/autoloader.php';
require __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class mailService  {

	public function __construct() {
		$this->db = database::getInstance();
		$this->conn = $this->db->getConnection();
	}


	public function sendMail($emailData, $pdf) : void
	{
		$mail = new PHPMailer(true);
		try
		{
			//Recipients
			$mail->SetFrom(EMAIL, 'The Haarlem Festival');
			// Add a recipient
			$mail->AddAddress($emailData['reciever'], $emailData['name']);

			$mail->Subject  = "Thank you for your purchase!";
			//Attachments
			$mail->AddStringAttachment($pdf,'Haarlem_Festival_Invoice.pdf','base64','application/pdf');

			$mail->Body = "This is your generated invoice for the Haarlem Festival events.";

			//Content
			$mail->isHTML(true);
			$mail->Subject = 
			$mail->Body    = $emailData['content'];
			$mail->send();
		}
		catch (Exception $e)
		{
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		};
	}
}

?>