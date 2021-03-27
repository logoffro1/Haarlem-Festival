<?php

include '../classes/autoloader.php';

class thankyoupageservice  {

	public function __construct() {

	}


	public function sendMail($emailData) : void
	{
		if (!mail($emailData['reciever'], $emailData['subject'], $emailData['content'], $emailData['sender']))
		{
			throw new Exception("could not send the email, please try again");
		}
	}
}

?>