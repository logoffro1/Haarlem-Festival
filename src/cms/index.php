<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("Events");
$navigation->render();

$jazzArtistTableList = array();
$danceArtistTableList = array();
$restaurantTableList = array();
$tourTableArray = array();

$artistController = new artistController();
$restaurantController = new restaurantController();
$tourController = new tourController();

$restaurants = $restaurantController->getRestaurants();
$jazzArtist = $artistController->getJazzArtistList();
$danceArtist = $artistController->getDanceArtistList();
$tourList = $tourController->getAllTours();


foreach ($tourList as $tour) {
    $tourArray = array();
    $tourArray[] = $tour->date;
    $tourArray[] = $tour->time;
    $tourArray[] = "<a class='align--flex-end' href='tour-detail-page.php?id=$tour->id'>Edit</a>";

    $tourTableArray[] = $tourArray;
}

foreach ($restaurants as $restaurant) {
    $restaurantArray = array();
    $restaurantArray[] = $restaurant->name;
    $restaurantArray[] = $restaurant->address;
    $restaurantArray[] = $restaurant->stars;
    $restaurantArray[] = "<div class='table--cms__item__navigation'>
    <a href='./restaurant-detail-page.php?id=$restaurant->id' class=''>Edit</a>
    </div>";
    
    $restaurantTableList[] = $restaurantArray;
}

foreach ($jazzArtist as $artist) {
    $artistArray = array();
    $artistArray[] = $artist->id;
    $artistArray[] = $artist->name;
    $artistArray[] = "<div class='table--cms__item__navigation'>
    <a href='./artist-detail-page.php?id=$artist->id' class=''>Edit</a>
    </div>";
    
    $jazzArtistTableList[] = $artistArray;
}

foreach ($danceArtist as $artist) {
    $danceArtistArray = array();
    $danceArtistArray[] = $artist->id;
    $danceArtistArray[] = $artist->name;
    $danceArtistArray[] = "<div class='table--cms__item__navigation'>
    <a href='./artist-detail-page.php?id=$artist->id' class=''>Edit</a>
    </div>";
    
    $danceArtistTableList[] = $danceArtistArray;
}

$historyTable = new table('card--cms__body table--cms', ['Date', 'Time', ''], $tourTableArray);
$jazzTable = new table('card--cms__body table--cms', ['ID', 'Band/Name', ''], $jazzArtistTableList);
$danceTable = new table('card--cms__body table--cms', ['ID', 'Band/Name', ''], $danceArtistTableList);
$restaurantTable = new table('card--cms__body table--cms', ['Name', 'Address', 'Stars', ''], $restaurantTableList);

?>

    <div class="cms-container">
        <nav class="breadcrumbs breadcrumbs--cms">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="">Events</a></li>
            </ul>
        </nav>
       
        <div class="js-tabs">
            <nav class="tabs--cms js-tabs-navigation">
                <ul class="tabs--cms__list">
                    <li><a data-content="jazz" class="is-active" href="#">Jazz</a></li>
                    <li><a data-content="dance" href="#">Dance</a></li>
                    <li><a data-content="history" href="#">History</a></li>
                    <li><a data-content="cuisine" href="#">Cuisine</a></li>
                </ul>
            </nav>
            <article data-content="jazz" class="card--cms js-tab-content is-active">
                <a href="./artist-detail-page.php?event=4" class="button button--top">Add artist</a>
                <?php
                     $jazzTable->render();
                ?>

            </article>
            <article data-content="dance" class="card--cms js-tab-content">
                <a href="./artist-detail-page.php?event=2" class="button button--top">Add artist</a>
                <?php
                     $danceTable->render();
                ?>

            </article>
            <article data-content="history" class="card--cms js-tab-content">
                <a href="./tour-detail-page.php" class="button button--top">Add tour</a>       
                <?php
                    $historyTable->render();
                ?>
            </article>
            <article data-content="cuisine" class="card--cms js-tab-content">
                <a href="./restaurant-detail-page.php" class="button button--top">Add restaurant</a>
                
                <?php
                    $restaurantTable->render();
                ?>
            </article>
        </div>
        
    </div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>
