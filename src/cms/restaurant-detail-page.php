<?php
include '../classes/autoloader.php';

$restaurantController = new restaurantController();
$restaurant = $restaurantController->getRestaurant();

if(isset($_POST['submit']))    
{
    $restaurantController->updateRestaurant($restaurant);
}

$breadcrumbsArray = array(
    array('text' => 'Edit Pages', 'url' => "/index.php"),
    array('text' => 'Cuisine Event', 'url' => "/cuisine-event.php"),
    array('text' => 'Restaurant Details', 'url' => "#"),
);
$breadcrumbs = new breadcrumbs($breadcrumbsArray, 'breadcrumbs--cms');

$cmsNotification = new cmsNotification('Error', $restaurantController->errors);


$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("Events");
$navigation->render();
?>

    <div class="cms-container row">
        <?php
            $breadcrumbs->render();
        ?>

        <div class="col-8">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Restaurant name</h3>
                </header>
                <form class="card--cms__body row" method="post">
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Name</label>
                        <input placeholder="enter the name..." type="text" name="name" value="<?php echo $restaurant->name ?? '';?>" id="name">
                    </fieldset>
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Adres</label>
                        <input placeholder="enter the adres..." type="text" name="address" value="<?php echo $restaurant->address ?? '';?>" id="adres">
                    </fieldset>
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Biography</label>
                        <textarea placeholder="enter the content..." name="biography" value="<?php echo $restaurant->biography ?? '';?>" id="biography"></textarea>
                    </fieldset>
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Duration of every session (in hours)</label>
                        <input placeholder="e.g 1.5..." step="0.5" type="number" name="duration" value="<?php echo $restaurant->duration ?? '' ?>">
                    </fieldset>
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Number of sessions</label>
                        <input placeholder="e.g 2..." type="number" name="sessions" value="<?php echo $restaurant->sessions ?? '' ?>">
                    </fieldset>
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Start first of sessions</label>
                        <input placeholder="e.g 18:00..." type="time" name="start_of_session" value="<?php echo $restaurant->startOfSession ?? '' ?>">
                    </fieldset>
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Seats available</label>
                        <input placeholder="e.g 75..." type="number" name="seats" value="<?php echo $restaurant->seats ?? '' ?>">
                    </fieldset>
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Stars of restaurant</label>
                        <input placeholder="e.g 4..." type="number" name="stars" value="<?php echo $restaurant->stars ?? '' ?>">
                    </fieldset>
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Price for dinner per seat</label>
                        <input placeholder="e.g 75.00..." type="number" steps="0.5" name="price" value="<?php echo $restaurant->price ?? '' ?>">
                    </fieldset>
                    <br/>
                    <div class="col-12 row justify-content-end">
                        <?php if(isset($_GET['id'])){
                            echo '<input class="button" type="submit" name="submit" value="Update restaurant">';
                        } else {
                            echo '<input class="button" type="submit" name="add" value="Create new restaurant">';
                        } 
                        ?>
                    </div>
                </form>
            </article>
        </div>

        <div class="col-4">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Restaurant Images</h3>
                </header>
                <form class="card--cms__body table--cms">
                    <img src="" alt="Artist Image">
                    <br/>
                    <button class="button">Upload Image</button>
                    <button class="button button--secondary">Delete</button>
                </form>
            </article>
            
         
        </div>

    </div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>
