<?php
    include '../classes/autoloader.php';
	@include '../controller/thankyoupagecontroller.php';
	@include '../service/thankyoupageservice.php';


    $head = new head("homepage", "");
    $head->render();

    $navigation = new navigation("Home");
    $navigation->render();

	$controller = new thankyoupagecontroller();
	$controller->sendMail($_SESSION);
	$thankyoupage = new thankyoupage();
	$thankyoupage->render();
?>

<?php
    $footer = new footer();
    $footer->renderFooter();
?>