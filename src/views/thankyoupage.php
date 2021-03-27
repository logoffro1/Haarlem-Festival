<?php
    include '../classes/autoloader.php';


    $head = new head("homepage", "");
    $head->render();

    $navigation = new navigation("Home");
    $navigation->render();

	$controller = new thankyoupagecontroller();
	$controller->sendMail();

	$thankyoupage = new thankyoupage();
	$thankyoupage->render();
?>

<?php
    $footer = new footer();
    $footer->renderFooter();
?>