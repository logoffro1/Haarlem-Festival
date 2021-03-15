<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$performanceController = new performanceController();
$artistController = new artistController();
$artist = $artistController->getSession();

if(isset($_GET['id'])){
    $performance = $performanceController->getPerformance();
}

if(isset($_GET['delete'])){
    $performanceController->deletePerformance($artist);
}

$locationController = new locationController();
$location = $locationController->getDanceLocations();

if(isset($_POST['add']))    
{
    $performanceController->addPerformance($artist);
}
if(isset($_POST['submit']))    
{
    $performanceController->updatePerformance();
}

$navigation = new cmsNavigation("Events");
$navigation->render();
?>

    <div class="cms-container row">
        <nav class="breadcrumbs breadcrumbs--cms col-12">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="edit-pages.php">Events</a></li>
                <li class="breadcrumbs__breadcrumb"><a href="#">Performance</a></li>
            </ul>
        </nav>
       
        <article class="card--cms col-8">
            <header class="card--cms__header">
                <h3 class="card--cms__header__title">Event Details</h3>
                <a href="artist-performance-details.php?id=<?php echo $performance->id ?>&delete=<?php echo $performance->id ?>" class="button button--secondary">Delete Performance</a>
            </header>
            <form class="card--cms__body row" method="post">
                <p class="card--cms__body__form-title col-12">Date and time</p>
                
                <fieldset class="col-6 col--children-fullwidth">
                    <label class="label">Date</label>
                    <input type="date" name="date" value="<?php echo $performance->date ?? ''; ?>">
                </fieldset>

                <fieldset class="col-6 col--children-fullwidth">
                    <label class="label">Start time</label>
                    <input type="time" name="start_time" id="start_time" value="<?php echo $performance->time ?? ''; ?>">
                </fieldset>

                <fieldset class="col-6 col--children-fullwidth">
                    <label class="label">Duration (in hours)</label>
                    <input type="number" name="duration" id="duration" value="<?php echo $performance->duration ?? ''; ?>">
                </fieldset>

                <p class="card--cms__body__form-title col-12">Location and tickets</p>
                
                <fieldset class="col-6 col--children-fullwidth">
                    <label class="label">Location</label>

                    <select name="location" class="has-placeholder">
                    <?php
                        if(isset($_GET['id'])){
                            echo "<option value=".$performance->location->id ?? ''." selected>". $performance->location->name ?? '' . "</option>";
                            
                        } else {
                            echo "<option value='' disabled selected hidden>Location...</option>";
                        }
                    ?>
                        <?php
                        foreach ($location as $l) {
                            echo "<option value=" . $l->mutateToArray()['id'] . ">" . $l->mutateToArray()['name'] . "</option>";
                        }
                        ?> 
                    </select>
                </fieldset>

                <fieldset class="col-6 col--children-fullwidth">
                    <label class="label">Available tickets*</label>
                    <input value="<?php $performance->tickets ?? ''?>" type="number" name="tickets">
                </fieldset>

                <p class="card--cms__body__additional">*The Seats and Price Per Ticket are based on the location.</p>

                <div class="col-12 row justify-content-end">
                    <div class="col-12 row justify-content-end">
                        <?php if(isset($_GET['id'])){
                            echo '<input class="button" type="submit" name="submit" value="Update performance">';
                        } else {
                            echo '<input class="button" type="submit" name="add" value="Create new performance">';
                        } 
                        ?>
                    </div>
                </div>
            </form>
        </article>
 
    </div>
    
<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>