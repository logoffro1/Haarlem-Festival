<?php
    include '../classes/autoloader.php';

    $contoller = new jazzArtistController();

    $head = new head("Gare du Nord | Haarlem Festival", "");
    $head->render();

    $navigation = new navigation("Events");
    $navigation->render();

    $jazzIntro = new jazzArtistInfo();
    $jazzIntro->render();

    $jazzSongs = new jazzSongCard();
    $jazzSongs->render();

    $artistPerformances = new jazzArtistPerformances();
    $artistPerformances -> render();
?>

<section class='container section'>
</section>

<?php 
    $swoosh = new jazzSwoosh();
    $swoosh->render();
    $footer = new footer();
    $footer->renderFooter();
?>