<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("Edit Pages");
$navigation->render();

$pageController = new pageController();
$page = $pageController->getPage(4);

if(isset($_POST['submit']))    
{
    $pageController->updatePage($page, 4);
}

foreach($_POST as $key => $value) {
    if (strpos($key, 'delete_image') === 0) {
        $pageController->deleteImage($page, 4, $key);
    }
}

$artistController = new artistController();
$artisList = $artistController->getJazzArtistList();


$artistTableArray = array();

foreach ($artisList as $artist) {
    $artistArray = array();
    $artistArray[] = $artist->name;
    $artistArray[] = "<a class='align--flex-end' href='artist-detail-page.php?event=4&id=$artist->id'>edit</a>";

    $artistTableArray[] = $artistArray;
}

$table = new table('card--cms__body table--cms', ['name', ''], $artistTableArray);
$cmsNotification = new cmsNotification('Error', $pageController->errors);

?>
    <div class="cms-container row">
        <nav class="breadcrumbs breadcrumbs--cms col-12">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="edit-pages.php">Edit Pages</a></li>
                <li class="breadcrumbs__breadcrumb"><a href="#">Jazz Event</a></li>
            </ul>
        </nav>

        <div class="col-8">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Page Content</h3>
                </header>
                <form class="card--cms__body row" method="post" enctype="multipart/form-data">
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Title</label>
                        <input placeholder="enter the title..." type="text" name="page_title" value="<?php echo $page->page_title ?? ''?>">
                    </fieldset>

                    <fieldset>
                        <label class="label">Hero Image</label>

                        <?php if(strlen($page->image) > 0) { ?>
                            <img src="<?php echo UPLOAD_FOLDER . $page->image ?>" alt="Artist Image">
                            <input class="button button--secondary" type="submit" name="delete_image-image" value="delete image">
                            <br/><br/>
                        <?php } else { ?>
                            <p>No image present</p>
                        <?php } ?>
                        <input type="file" name="image" >
                    </fieldset>

                    <br/>
                    <div class="col-12 row justify-content-end">
                        <input class="button" type="submit" name="submit" value="Update jazz page">
                    </div>
                </form>
            </article>
        </div>

        <div class="col-4">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Artists</h3>
                    <a href="artist-detail-page.php?event=4" class="button button--secondary">Add artist</a>
                </header>
                <?php
                    $table->render();
                ?>
            </div>
        </div>

        <?php
            $cmsNotification->render();
        ?>
    </div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>
