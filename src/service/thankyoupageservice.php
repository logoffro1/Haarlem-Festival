<?php

include '../classes/autoloader.php';
require __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class thankyoupageservice  {

	public function __construct() {

	}


	public function sendMail($emailData) : void
	{
		$mail = new PHPMailer(true);
		try
		{
				//Recipients
				$mail->setFrom(EMAIL, 'The Haarlem Festival');
				$mail->addAddress($emailData['reciever'], $emailData['name']);     // Add a recipient


				//Attachments
				$mail->addAttachment('E:\Work\University\Term 2.3\Project Haarlem Festival Website\Haarlem-Festival\src\assets\TEST PDF.pdf');         // Add attachments


				//Content
				$mail->isHTML(true);
				$mail->Subject = $emailData['subject'];
				$mail->Body    = $emailData['content'];
				$mail->send();
				echo 'Message has been sent';
		}
		catch (Exception $e)
		{
		echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		};
	}
}

?>