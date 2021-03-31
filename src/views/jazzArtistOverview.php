<?php
    include '../classes/autoloader.php';
    include '../components/cart/cartSession.php';

    //Checking if artist is selected
    if (isset($_GET['artist']))
    { 
        //Getting the selected artist ID so that relevenat information can be printed
        $id = intval($_GET['artist']);
        $controller = new artistController();
        $artist = $controller->getArtistById($id);

        $artistName = $artist->name;
        $head = new head("$artistName | Haarlem Festival", "");
        $head->render();

        $navigation = new navigation("Events");
        $navigation->render();

        $jazzInfo = new jazzArtistInfo($artist);
        $jazzInfo->render();

        //Notification component has been added, will be activated when necessary
        $jazzNotification = new jazzNotification();
        $jazzNotification->render();

        $jazzSongs = new jazzSongCard($artist->__get('songs'), $artist->__get('name'));
        $jazzSongs->render();

        $artistPerformances = new artistPerformances($artist->__get('performances'), 'jazz');
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
        //If performanceID is set, it means a new item has been added to cart, so a notification is being displayed here
        if(isset($_GET['performanceID']))
            $jazzNotification->displayNotification("A ticket for $artistName has been added to your cart succesfully!" );
    }
    ?>
    
