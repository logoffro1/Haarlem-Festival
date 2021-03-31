<?php
    include '../classes/autoloader.php';

    if (isset($_GET['artist']))
    {
        $id = intval($_GET['artist']);
        $controller = new artistController();
        $artist = $controller->getArtistById($id);

        $artistName = $artist->__get('name');
        $head = new head("$artistName | Haarlem Festival", "");
        $head->render();

        $navigation = new navigation("Events");
        $navigation->render();

        $danceInfo = new danceArtistInfo($artist);
        $danceInfo->render();

        $danceSongs = new danceSongCard($artist->__get('songs'), $artist->__get('name'));
        $danceSongs->render();

        $artistPerformances = new artistPerformances($artist->__get('performances'), 'dance');
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
?>