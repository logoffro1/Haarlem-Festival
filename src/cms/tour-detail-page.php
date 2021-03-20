<?php
include '../classes/autoloader.php';


$tourController = new tourController();
$tourExists = isset($_GET['id']);

if($tourExists){
    $tour = $tourController->getTourByID($_GET['id']);
}

if(isset($_GET['delete'])){
    $tourController->deleteTour($tour);
}

if(isset($_POST['submit']))    
{
    $tourController->updateTour($tour);
}

if(isset($_POST['add']))    
{
    $tourController->addTour();
}

if(isset($_POST['add_english']) || isset($_POST['add_dutch']) || isset($_POST['add_chinese']))    
{
    $tourController->addTourType($tour);
}

if(isset($_POST['update_english']) || isset($_POST['update_dutch']) || isset($_POST['update_chinese']))    
{
    $tourController->updateTourType($tour);
}

$breadcrumbsArray = array(
    array('text' => 'Edit Pages', 'url' => "/index.php"),
    array('text' => 'History Event', 'url' => "history-event.php"),
    array('text' => 'Tour Details', 'url' => "#"),
);
$breadcrumbs = new breadcrumbs($breadcrumbsArray, 'breadcrumbs--cms');

$cmsNotification = new cmsNotification('Error', $tourController->errors);

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
                    <h3 class="card--cms__header__title">Tour Details</h3>
                    <?php
                        if($tourExists) {
                    ?>
                            <a href="tour-detail-page.php?delete=<?php echo $tour->id; ?>&id=<?php echo $tour->id; ?>" class="button button--secondary">Delete Tour</a>
                    <?php
                        }
                    ?>
                </header>
                <form class="card--cms__body row" method="post">
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Date</label>
                        <input required placeholder="tets" type="date" name="date" value="<?php echo $tour->date ?? '';?>">
                    </fieldset>
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Start Time</label>
                        <input required placeholder="tets" type="time" name="time" value="<?php echo $tour->time ?? '';?>">
                    </fieldset>
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Price</label>
                        <input required placeholder="e.g 17.50" type="number" step="0.50" name="price" value="<?php echo $tour->price ?? '';?>">
                    </fieldset>
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Family Price (4 tickets)</label>
                        <input required placeholder="e.g 50.00" type="number" step="0.50" name="family_price" value="<?php echo $tour->family_price ?? '';?>">
                    </fieldset>
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Seats per tour</label>
                        <input required placeholder="e.g 30" type="number" name="seats" value="<?php echo $tour->seats ?? '' ?>">
                    </fieldset>
                  
                    <br/>
                    <div class="col-12 row justify-content-end">
                        <?php if($tourExists){
                            echo '<input class="button" type="submit" name="submit" value="Update tour">';
                        } else {
                            echo '<input class="button" type="submit" name="add" value="Create new tour">';
                        } 
                        ?>
                    </div>
                </form>
            </article>
        </div>

        <?php
            if($tourExists) {
        ?>
            <div class="col-8">
                <article class="card--cms">
                    <header class="card--cms__header">
                        <h3 class="card--cms__header__title">Languages and Amount of tours</h3>
                    </header>

                    <?php
                    $languages = ['Dutch', 'English', 'Chinese'];
                    foreach ($languages as $language) { ?>
                        <form class="card--cms__body row align-items-center" method="post">
                            <fieldset class="col-3 col--children-fullwidth">
                                <label class="label">Language</label>
                                
                                <p class="no-margin">
                                    <strong><?php echo $language ?></strong>
                                </p>
                            </fieldset>

                            <fieldset class="col-4 col--children-fullwidth">
                                <label class="label white-space--no-wrap">Amount of tours ('0' to delete the tour)</label>
                                
                                <?php 
                                    $hasLanguage = false;
                                    foreach ($tour->tourTypes as $type) {
                                        if($type->language == $language){
                                            $hasLanguage = true;
                                            echo '<input required type="number" min="0" name="number_of_tours" value="'.$type->amountOfTours.'">';
                                            break;
                                        }
                                    }

                                    if(!$hasLanguage) {
                                        echo '<input required type="number" min="0" name="number_of_tours" value="">';
                                    }
                                ?>
                            </fieldset>
                            <fieldset class="col-offset-1 col-2 col--children-fullwidth">
                                <input class="button" type="submit" name="<?php echo $hasLanguage ? 'update_'.strtolower($language) : 'add_'.strtolower($language); unset($hasLanguage); ?>" value="Update Tour">
                            </fieldset>
                        </form>
                    <?php } ?>
                </article>
            </div>
        <?php
            }
            $cmsNotification->render(); 
        ?>
    </div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>
