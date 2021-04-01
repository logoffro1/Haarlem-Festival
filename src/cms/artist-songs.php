<?php
include '../classes/autoloader.php';
include_once '../config/config.php';


$head = new head("CMS - Dashboard", "page--cms");
$head->render();

if(isset($_GET['event']))    
{
    $eventId = $_GET['event'];
}
// Get artist
$artistController = new artistController();
$artist = $artistController->getSession();

$songController = new songController();
$song = $songController->getSong();

if(isset($_POST['delete']))    
{
    $songController->deleteSong($song, $artist);
}

if(isset($_POST['delete_image']))    
{
    $songController->deleteSongImage($song);
}

if(isset($_POST['add']))    
{
    $songController->addSong($artist->id);
}

if(isset($_POST['submit']))    
{
    $songController->updateSong($song);
}

$navigation = new cmsNavigation("Events");
$navigation->render();

$breadcrumbsArray = array(
    array('text' => $artist->name, 'url' => "./artist-detail-page.php?id=$artist->id&event=$eventId")
);
$breadcrumbs = new breadcrumbs($breadcrumbsArray, 'breadcrumbs--cms');

$cmsNotification = new cmsNotification('Error', $songController->errors);
?>
 <div class="cms-container row">
    <?php $breadcrumbs->render() ?>

    
    <article class="card--cms col-8">
        <header class="card--cms__header">
            <h3 class="card--cms__header__title">Song Details</h3>
        </header>
        <form class="card--cms__body row" method="post" enctype="multipart/form-data" action="">
            <p class="card--cms__body__form-title col-12">
            Song
            
            <?php
                if(isset($_GET['id'])){
                    echo '<div class="align--flex-end"><input class="button button--secondary" type="submit" name="delete" value="Delete song"></div>';
                }
            ?>
            </p>
            <fieldset class="col-12 col--children-fullwidth">
                <label class="label">Song title</label>
                <input placeholder="Title..." type="text" name="title" id="title" value="<?php echo $song->title ?? ''; ?>">
            </fieldset>
            <fieldset class="col-12 col--children-fullwidth">
                <label class="label">Song url</label>
                <input placeholder="Url..." type="text" name="url" id="url" value="<?php echo $song->url ?? ''; ?>">
            </fieldset>

            <fieldset>
                <?php if($song && strlen($song->image) > 0) { ?>
                    <img src="<?php echo$song->image ?>" alt="Artist Image">
                    <br/>
                    <input class="button button--secondary" type="submit" value="Delete image" name="delete_image">
                <?php } else { ?>
                    <p>No image present</p>
                <?php } ?>
                <input type="file" name="image">
            </fieldset>
            <br/>
            <div class="col-12 row justify-content-end">
            <?php if(isset($_GET['id'])){
                echo '<input class="button" type="submit" name="submit" value="Update song">';
            } else {
                echo '<input class="button" type="submit" name="add" value="Create new song">';
            } 
            ?>
            </div>
        </form>
    </article>
    <?php
        $cmsNotification->render();
    ?>
</div>
    
<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>