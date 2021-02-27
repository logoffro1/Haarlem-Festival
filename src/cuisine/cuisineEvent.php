<?php
include '../classes/autoloader.php';

$head = new head("Cuisine Event", "");
$head->render();

$navigation = new navigation("Cuisine Event");
$navigation->render();
?>



<?php 
 $footer = new footer();
 $footer->renderFooter();
?>