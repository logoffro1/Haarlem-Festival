<?php
    include '../classes/autoloader.php';
    include '../components/cart/cartSession.php';

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

        $danceInfo = new artistInfo($artist, 'dance');
        $danceInfo->render();

        //Notification component has been added, will be activated when necessary
        $notification = new notification();
        $notification->render();

        $danceSongs = new songCard($artist->__get('songs'), $artist->__get('name'));
        $danceSongs->render();

        $artistPerformances = new artistPerformances($artist->__get('performances'), 'dance');
        $artistPerformances -> render();

        $exploreHaarlem = new danceExploreHaarlem();
        $exploreHaarlem->render();

        $exploreMap = new exploreMap('dance');
        $exploreMap->render();

        $jazzArtist = $controller->getARandomJazzArtist();
        $jazzCard = new danceJazzSuggestion($jazzArtist->__get('name'), $jazzArtist->__get('thumbnail'), $jazzArtist->__get('id'), $jazzArtist->__get('performances'),"dance");
        $jazzCard->render();

        $swoosh = new swoosh('dance');
        $swoosh->render();

        $footer = new footer();
        $footer->renderFooter();

        $_SESSION['cart']->render();
        //If performanceID is set, it means a new item has been added to cart, so a notification is being displayed here
        if(isset($_GET['performanceID']))
            $notification->displayNotification("A ticket for $artistName has been added to your cart succesfully!", "dance" );
    }
?>