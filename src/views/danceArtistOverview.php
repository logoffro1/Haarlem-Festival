<?php
    include '../classes/autoloader.php';

    if (isset($_GET['artist']))
    {
        $id = intval($_GET['artist']);
        $controller = new danceArtistController();
        $artist = $controller->getADanceArtistById($id);

        $artistName = $artist->__get('artistName');
        $head = new head("$artistName | Haarlem Festival", "");
        $head->render();

        $navigation = new navigation("Events");
        $navigation->render();

        $danceInfo = new danceArtistInfo($artist);
        $danceInfo->render();

        $danceSongs = new danceSongCard($artist->__get('songs'), $artist->__get('artistName'));
        $danceSongs->render();

        $artistPerformances = new jazzArtistPerformances($artist->__get('performances'));
        $artistPerformances -> render();
        }
        $exploreHaarlem = new danceExploreHaarlem();
        $exploreHaarlem->render();

        $exploreMap = new danceExploreMap();
        $exploreMap->render();

        $jazzSuggestion = new danceJazzSuggestion();
        $jazzSuggestion->render();

        $swoosh = new danceSwoosh();
        $swoosh->render();

        $footer = new footer();
        $footer->renderFooter();
        $_SESSION['cart']->render();
        //If performanceID is set, it means a new item has been added to cart, so a notification is being displayed here
?>