<?php
    include '../classes/autoloader.php';
    $contoller = new cuisineEventController();
    $restaurantTypeController = new restaurantTypeController();
    $restaurantController = new restaurantController();
    $restaurants = $restaurantController->getRestaurants();
    $head = new head("Cuisine Event", "");
    $head->render();

    $navigation = new navigation("");
    $navigation->render();

?>
<section class='container section' style='margin-top:-50px;'>
    <pre style='letter-spacing:1px'><a href = 'cuisineEvent.php'>Haarlem Cuisine </a> > <a href = '#'> Ratatouille</a> </pre>
    <h1 class='title title--page cuisine'> Ratatouille </h1>

</section>
<?php 
    $footer = new footer();
    $footer->renderFooter();
?>