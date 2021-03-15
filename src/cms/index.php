<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("Events");
$navigation->render();

$jazzArtistTableList = array();
$danceArtistTableList = array();
$restaurantTableList = array();

$artistController = new artistController();
$restaurantController = new restaurantController();

$restaurants = $restaurantController->getRestaurants();
$jazzArtist = $artistController->getJazzArtistList();
$danceArtist = $artistController->getDanceArtistList();


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
    $artistArray[] = $artist->name;
    $artistArray[] = count(array($artist->performances));
    $artistArray[] = count(array($artist->songs));
    $artistArray[] = "<div class='table--cms__item__navigation'>
    <a href='./artist-detail-page.php?id=$artist->id' class=''>Edit</a>
    </div>";
    
    $jazzArtistTableList[] = $artistArray;
}


foreach ($danceArtist as $artist) {
    $danceArtistArray = array();
    $danceArtistArray[] = $artist->name;
    $danceArtistArray[] = count(array($artist->performances));
    $danceArtistArray[] = count(array($artist->songs));
    $danceArtistArray[] = "<div class='table--cms__item__navigation'>
    <a href='./artist-detail-page.php?id=$artist->id' class=''>Edit</a>
    </div>";
    
    $danceArtistTableList[] = $danceArtistArray;
}

$jazzTable = new table('card--cms__body table--cms', ['Band/Name', 'Amount of performances', 'Amount of songs', ''], $jazzArtistTableList);
$danceTable = new table('card--cms__body table--cms', ['Band/Name', 'Amount of performances', 'Amount of songs', ''], $danceArtistTableList);
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
                <button href="./artist-detail-page.php" class="button button--top">Add artist</button>
                <?php
                     $jazzTable->render();
                ?>

            </article>
            <article data-content="dance" class="card--cms js-tab-content">
                <button class="button button--top">Add artist</button>
                <?php
                     $danceTable->render();
                ?>

            </article>
            <article data-content="history" class="card--cms js-tab-content">
                <button class="button button--top">Add artist</button>
                
                <div class="table table--cms card--cms__body">
                    Edit content
                </div>
            </article>
            <article data-content="cuisine" class="card--cms js-tab-content">
                <button class="button button--top">Add restaurant</button>
                
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
