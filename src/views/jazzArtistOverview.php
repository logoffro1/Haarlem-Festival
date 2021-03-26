<?php
    include '../classes/autoloader.php';
    include '../components/cart/cartSession.php';

    
    if (isset($_GET['artist']))
    { 
        $id = intval($_GET['artist']);
        $controller = new jazzArtistController();
        $artist = $controller->getAJazzArtistById($id);

        $artistName = $artist->__get('artistName');
        $head = new head("$artistName | Haarlem Festival", "");
        $head->render();

        $navigation = new navigation("Events");
        $navigation->render();

        $jazzInfo = new jazzArtistInfo($artist);
        $jazzInfo->render();

        $jazzNotification = new jazzNotification();
        $jazzNotification->render();

        $jazzSongs = new jazzSongCard($artist->__get('songs'), $artist->__get('artistName'));
        $jazzSongs->render();

        $artistPerformances = new jazzArtistPerformances($artist->__get('performances'));
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

        
        $_SESSION['cart']->render();
        if(isset($_GET['performanceID']))
            $jazzNotification->displayNotification("A ticket for $artistName has been added to your cart succesfully!" );
    }
    ?>
    
