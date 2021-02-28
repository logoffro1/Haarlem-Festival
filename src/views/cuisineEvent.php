<?php
    include '../classes/autoloader.php';
    $contoller = new cuisineEventController();

    $head = new head("Cuisine Event", "");
    $head->render();

    $navigation = new navigation("Home");
    $navigation->render();
?>

<section class="container section">
<pre style="letter-spacing:1px"><a href = "#">Events </a> > <a hrtef = "#"> Haarlem Cuisine</a> </pre>
<h1 class="title title--page cuisine"> The Haarlem Cuisine </h1>

<img src="../assets/images/cuisineBanner.png" class="banner" alt="The Haarlem Festival" title="The Haarlem Cuisine">
</section>


<?php 
    $footer = new footer();
    $footer->renderFooter();
?>
