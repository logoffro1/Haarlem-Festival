<?php
    include '../classes/autoloader.php';
    session_start();

    $head = new head("homepage", "");
    $head->render();

    $navigation = new navigation("Home");
    $navigation->render();

	$controller = new thankyoupagecontroller();
	$controller->sendMail($_SESSION['email'],"Thank you for your purchase!",$_SESSION['fname']); //last parameter should be the pdf

	$thankyoupage = new thankyoupage();
	$thankyoupage->render();
?>

<?php
    $footer = new footer();
    $footer->renderFooter();
?>