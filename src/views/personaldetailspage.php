<?php
    include '../classes/autoloader.php';

    $head = new head("homepage", "");
    $head->render();

    $navigation = new navigation("Home");
    $navigation->render();

	$personaldetails = new personaldetails();
	$personaldetails->render();

	session_start();
	$_SESSION["reciever"] = 'email';
	$_SESSION["subject"] = 'fname';
	$_SESSION["content"] = 'lname';
	$_SESSION["sender"] = 'localhost';
?>

<?php
    $footer = new footer();
    $footer->renderFooter();
?>