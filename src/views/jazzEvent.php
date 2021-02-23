<?php
    include '../classes/autoloader.php';

    $contoller = new jazzEventController();

    $head = new head("homepage", "");
    $head->render();

    $navigation = new navigation("Home");
    $navigation->render();
?>

<section class="container section">


</section>

<?php 
    $footer = new footer();
    $footer->renderFooter();
?>
