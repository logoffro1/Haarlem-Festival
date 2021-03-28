<?php
    include '../classes/autoloader.php';

    $head = new head("homepage", "");
    $head->render();

    $navigation = new navigation("Home");
    $navigation->render();

	$personaldetails = new personaldetails();
	$personaldetails->render();
?>

<?php
    $footer = new footer();
    $footer->renderFooter();
?>