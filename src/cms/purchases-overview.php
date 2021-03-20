<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("Events");
$navigation->render();


$restaurantTableList = array();
$restaurantController = new restaurantController();
$restaurants = $restaurantController->getRestaurants();

foreach ($danceArtist as $artist) {
    $danceArtistArray = array();
    $danceArtistArray[] = $artist->id;
    $danceArtistArray[] = $artist->name;
    $danceArtistArray[] = "<div class='table--cms__item__navigation'>
    <a href='./artist-detail-page.php?id=$artist->id' class=''>Edit</a>
    </div>";
    
    $danceArtistTableList[] = $danceArtistArray;
}

$restaurantTable = new table('card--cms__body table--cms', ['Name', 'Address', 'Stars', ''], $restaurantTableList);

?>

    <div class="cms-container">
        <nav class="breadcrumbs breadcrumbs--cms">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="">Events</a></li>
            </ul>
        </nav>
       
        <article class="card--cms col-8">
            <header class="card--cms__header">
                <h3 class="card--cms__header__title">Tickets</h3>
            </header>
           
            <?php
                $tickets->render();
            ?>
        </article>
        
    </div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>
