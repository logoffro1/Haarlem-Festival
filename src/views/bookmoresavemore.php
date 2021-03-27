<?php
    include '../classes/autoloader.php';

    $head = new head("homepage", "");
    $head->render();

    $navigation = new navigation("Home");
    $navigation->render();

	$bookmoresavemore = new bookmoresavemore();
	$bookmoresavemore->render();
?>

<?php
    $footer = new footer();
    $footer->renderFooter();
?>