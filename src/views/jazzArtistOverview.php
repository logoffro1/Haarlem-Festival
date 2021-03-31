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

        $jazzInfo = new artistInfo($artist, 'jazz');
        $jazzInfo->render();

        //Notification component has been added, will be activated when necessary
        $notification = new notification();
        $notification->render();

        $jazzSongs = new songCard($artist->__get('songs'), $artist->__get('name'));
        $jazzSongs->render();

        $artistPerformances = new artistPerformances($artist->__get('performances'), 'jazz');
        $artistPerformances -> render();

        $exploreHaarlem = new jazzExploreHaarlem();
        $exploreHaarlem->render();

        $exploreMap = new exploreMap('jazz');
        $exploreMap->render();

        $danceSuggestion = new jazzDanceSuggestion();
        $danceSuggestion->render();

        $swoosh = new swoosh('jazz');
        $swoosh->render();
        
        $footer = new footer();
        $footer->renderFooter();

        
        $_SESSION['cart']->render();
        //If performanceID is set, it means a new item has been added to cart, so a notification is being displayed here
        if(isset($_GET['performanceID']))
            $notification->displayNotification("A ticket for $artistName has been added to your cart succesfully!" );
    }
    ?>
    
