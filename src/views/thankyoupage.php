<?php
    include '../classes/autoloader.php';
    session_start();

    $head = new head("homepage", "");
    $head->render();

    $navigation = new navigation("Home");
    $navigation->render();

	$controller = new thankyoupagecontroller();
	$controller->sendMail($_SESSION['email'],"Thank you for your purchase!","We look forward to seeing you at our festival ".$_SESSION['fname']." ".$_SESSION['lname'],$_SESSION['fname']);
	$thankyoupage = new thankyoupage();
	$thankyoupage->render();
    //unset($_SESSION['email']);
    //unset($_SESSION['fname']);
    //unset($_SESSION['lname']);
    //unset($_SESSION['dob']);
    //unset($_SESSION['phoneno']);
?>

<?php
    $footer = new footer();
    $footer->renderFooter();
?>