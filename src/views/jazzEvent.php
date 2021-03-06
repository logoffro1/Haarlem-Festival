<?php
    include '../classes/autoloader.php';

    $contoller = new jazzEventController();

    $head = new head("Jazz Event", "");
    $head->render();

    $navigation = new navigation("Events");
    $navigation->render();

?>

<section class='container section' style='margin-top: -10px'>

<?php
  $jazzIntro = new jazzIntro();
  $jazzIntro->render();

  $artists = array("Artist1", "Artist2", "Artist3");
  $dates = array("Thursday, 26 July", "Friday, 27 July","Saturday, 28 July", "Sunday, 29 July");

  $cmb = new jazzComboBox($artists, $dates);
  $cmb->render();
?>

  <p style="font-size: 14px"> There are 3 event(s) listed.</p>

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
    $swoosh = new jazzSwoosh();
    $swoosh->render();
    $footer = new footer();
    $footer->renderFooter();
?>
