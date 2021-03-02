<?php
    include '../classes/autoloader.php';

    $contoller = new jazzEventController();

    $head = new head("Jazz Event", "");
    $head->render();

    $navigation = new navigation("Events");
    $navigation->render();
?>

<section class="container section">
<h1 class="header">Upcoming Jazz Events</h1>

<?php 
$card_test = new jazzEventCard("Gumbo Kings", "18:00 - 19:00", "Main Hall, Patronaat", "26 July", "#", "https://i.scdn.co/image/4f6740f2892dda60259a29b52ba96977e26b0b9a");
$card_test->render();

$card_test2 = new jazzEventCard("Gumbo Kings", "18:00 - 19:00", "Main Hall, Patronaat", "26 July", "#", "https://i.scdn.co/image/4f6740f2892dda60259a29b52ba96977e26b0b9a");
$card_test2->render();

$card_test3 = new jazzEventCard("Gumbo Kings", "18:00 - 19:00", "Main Hall, Patronaat", "26 July", "#", "https://i.scdn.co/image/4f6740f2892dda60259a29b52ba96977e26b0b9a");
$card_test3->render();

?>

</section>

<?php 
    $footer = new footer();
    $footer->renderFooter();
?>
