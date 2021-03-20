<?php
    include '../classes/autoloader.php';

    $contoller = new jazzArtistController();

    $head = new head("Gare du Nord | Haarlem Festival", "");
    $head->render();

    $navigation = new navigation("Events");
    $navigation->render();

    $jazzInfo = new jazzArtistInfo();
    $jazzInfo->render();

    $jazzSongs = new jazzSongCard();
    $jazzSongs->render();

    $artistPerformances = new jazzArtistPerformances();
    $artistPerformances -> render();

    $exploreHaarlem = new jazzExploreHaarlem();
    $exploreHaarlem->render();

    $exploreMap = new jazzExploreMap();
    $exploreMap->render();

    $danceSuggestion = new jazzDanceSuggestion();
    $danceSuggestion->render();

    $swoosh = new jazzSwoosh();
    $swoosh->render();
    
    $footer = new footer();
    $footer->renderFooter();
?>