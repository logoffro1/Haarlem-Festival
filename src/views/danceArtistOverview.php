<?php
    include '../classes/autoloader.php';
    include '../components/dance/danceExploreMap.php';
    include '../components/dance/danceExploreHaarlem.php';
    include '../components/dance/danceJazzSuggestion.php';
    include '../components/dance/danceSwoosh.php';
    include '../components/dance/danceArtistInfo.php';
    include '../components/dance/danceSongCard.php';
    include '../components/dance/danceArtistPerformances.php';


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

        $artistPerformances = new danceArtistPerformances($artist->__get('performances'));
        $artistPerformances -> render();
        }
        $exploreHaarlem = new danceExploreHaarlem();
        $exploreHaarlem->render();

        $exploreMap = new danceExploreMap();
        $exploreMap->render();

        $jazzSuggestion = new danceDanceSuggestion();
        $jazzSuggestion->render();

        $swoosh = new danceSwoosh();
        $swoosh->render();

        $footer = new footer();
        $footer->renderFooter();
?>