<?php
include '../classes/autoloader.php';


$tourController = new tourController();

if(isset($_GET['id'])){
    $tour = $tourController->getTourByID($_GET['id']);

    $tourTableArray = array();

    foreach ($tour->tourTypes as $tourType) {
        $tourArray = array();
        $tourArray[] = $tourType->amountOfTours;
        $tourArray[] = $tourType->language;

        $tourArray[] = "<a class='align--flex-end' href='tour-detail-page.php?delete_tour=$tourType->tour_type_id'>Delete</a>";

        $tourTableArray[] = $tourArray;
    }

    $table = new table('card--cms__body table--cms', ['Amount', 'Language', ''], $tourTableArray);
}

if(isset($_POST['submit']))    
{
    $tourController->updateTour($tour);
}

if(isset($_POST['add']))    
{
    $tourController->addTour();
}

$breadcrumbsArray = array(
    array('text' => 'Edit Pages', 'url' => "/index.php"),
    array('text' => 'History Event', 'url' => "history-event.php"),
    array('text' => 'Tour Details', 'url' => "#"),
);
$breadcrumbs = new breadcrumbs($breadcrumbsArray, 'breadcrumbs--cms');

$cmsNotification = new cmsNotification('Error', $tourController->errors);

$languageOptions = [
    [
        'value' => 'English',
        'text' => 'English'
    ],
    [
        'value' => 'Dutch',
        'text' => 'Dutch'
    ],
    [
        'value' => 'Chinese',
        'text' => 'Chinese'
    ],
];

$languageSelect = new select('language', $languageOptions);

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
                </header>
                <form class="card--cms__body row" method="post">
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Date</label>
                        <input type="date" name="date" value="<?php echo $tour->date ?? '';?>">
                    </fieldset>
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Start Time</label>
                        <input type="time" name="time" value="<?php echo $tour->time ?? '';?>">
                    </fieldset>
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Price</label>
                        <input type="number" steps="0.5" name="price" value="<?php echo $tour->price ?? '';?>">
                    </fieldset>
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Family Price (4 tickets)</label>
                        <input type="number" steps="0.5" name="family_price" value="<?php echo $tour->family_price ?? '';?>">
                    </fieldset>
                    <fieldset class="col-6 col--children-fullwidth">
                        <label class="label">Seats per tour</label>
                        <input type="number" name="seats" value="<?php echo $tour->seats ?? '' ?>">
                    </fieldset>
                  
                    <br/>
                    <div class="col-12 row justify-content-end">
                        <?php if(isset($_GET['id'])){
                            echo '<input class="button" type="submit" name="submit" value="Update tour">';
                        } else {
                            echo '<input class="button" type="submit" name="add" value="Create new tour">';
                        } 
                        ?>
                    </div>
                </form>
            </article>
        </div>

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
                            <label class="label">Amount ('0' to delete the tour)</label>
                            
                            <?php 
                                $hasLanguage = false;
                                foreach ($tour->tourTypes as $type) {
                                    if($type->language == $language){
                                        $hasLanguage = true;
                                        echo '<input type="number" name="'. strtolower($language) .'_seats" value="'.$type->amountOfTours.'">';
                                        break;
                                    }
                                }

                                if(!$hasLanguage) {
                                    echo '<input type="number" name="'. strtolower($language) .'_seats" value="">';
                                }
                            ?>
                        </fieldset>
                        <fieldset class="col-offset-1 col-2 col--children-fullwidth">
                            <input class="button" type="submit" name="<?php echo $hasLanguage ? 'update' : 'add'; unset($hasLanguage); ?>" value="Update Tour">
                        </fieldset>
                    </form>
                <?php } ?>
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
