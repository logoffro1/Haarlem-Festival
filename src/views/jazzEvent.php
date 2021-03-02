<?php
    include '../classes/autoloader.php';

    $contoller = new jazzEventController();

    $head = new head("Jazz Event", "");
    $head->render();

    $navigation = new navigation("Events");
    $navigation->render();

?>

<section class="container section">

<!-- TODO BELOW WILL BE CREATED WITH A PHP METHOD  -->
<h1 class='title title--page jazz'> Upcoming Jazz Events </h1>
<img class='hero' src='../assets/images/jazz/haarlem-jazz-main.png'>

<section class='cmb--jazz'>
  <select class='cmb--jazz__box'>
    <option value="allArtist">All Artists</option>
    <option value="artist">Artist</option>
    <option value="artist">Artist</option>
    <option value="artist">Artist</option>
    <option value="artist">Artist</option>
  </select>

  <select select class='cmb--jazz__box'>
    <option value="allDate">Date</option>
    <option value="date">Thursday, 26 July</option>
    <option value="date">Friday, 27 July</option>
    <option value="date">Saturday, 28 July</option>
    <option value="date">Sunday, 29 July</option>
  </select>
  </section>
  <p style="font-size: 14px"> There are 3 event(s) listed.</p>
  <!-- TODO ABOVE WILL BE CREATED WITH A PHP METHOD  -->
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
