<?php
include '../classes/autoloader.php';

$restaurantController = new restaurantController();
$restaurantType = new restaurantTypeController();
$restaurant = $restaurantController->getRestaurant();
$restaurantTypeList = $restaurantType->getRestaurantTypes();

if(isset($_POST['submit']))    
{
    $restaurantController->updateRestaurant($restaurant);
}

if(isset($_POST['add']))    
{
    $restaurantController->addRestaurant();
}

$breadcrumbsArray = array(
    array('text' => 'Edit Pages', 'url' => "/index.php"),
    array('text' => 'Cuisine Event', 'url' => "cuisine-event.php"),
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
                        <label class="label">Restaurant Type</label>

                        <div class="js-dropdown dropdown--cms">
                            <div href="#" class="js-dropdown__anchor input">
                            <spap>
                                Open restaurant type dropdown
                            </spap>    
                            </div>
                            <ul class="js-dropdown__body">
                                <div class="row">
                                    <?php
                                        foreach ($restaurantTypeList as $type) {
                                    ?>
                                            <li class="col-6">
                                                <label for="<?php echo $type->id; ?>">
                                                    <input type="checkbox" 
                                                    id="<?php echo $type->id; ?>" 
                                                    value="<?php echo $type->id; ?>" 
                                                    name="restaurant_type[]"
                                                    <?php
                                                        // Check which categories are selected 
                                                        foreach ($restaurant->cuisines as $cuisine) {
                                                            if($type->id == $cuisine->id){
                                                                echo "checked";
                                                            }
                                                        }
                                                    ?>
                                                    >
                                                    <?php echo $type->name; ?>
                                                </label>
                                            </li>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </ul>
                        </div>
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
                <form class="card--cms__body row" method="post" enctype="multipart/form-data">
                    <?php if(!empty($restaurant->image)) { ?>
                        <img src="<?php echo UPLOAD_FOLDER . $restaurant->image ?>" alt="restaurant Image">
                        <br/>
                    <?php } else { ?>
                        <p>No image present</p>
                    <?php } ?>
                    <input type="file" name="image" >
                    <br/>
                    <input class="button" type="submit" name="submit" value="Update image">
                    <br/>
                    <input class="button" type="submit" name="delete" value="Delete image">
                </form>
            </article>
            
        
        </div>
        <?php
            $cmsNotification->render(); 
        ?>
    </div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>
