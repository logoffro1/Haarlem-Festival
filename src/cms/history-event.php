<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("Edit Pages");
$navigation->render();

$pageController = new pageController();
$page = $pageController->getPage(3);

if(isset($_POST['submit']))    
{
    $pageController->updatePage($page, 3);
}

foreach($_POST as $key => $value) {
    if (strpos($key, 'delete_image') === 0) {
        $pageController->deleteImage($page, 3, $key);
    }
}


$tourController = new tourController();
$tourList = $tourController->getAllTours();

$tourTableArray = array();

foreach ($tourList as $tour) {
    $tourArray = array();
    $tourArray[] = $tour->date;
    $tourArray[] = $tour->time;
    $tourArray[] = "<a class='align--flex-end' href='tour-detail-page.php?id=$tour->id'>edit</a>";

    $tourTableArray[] = $tourArray;
}

$table = new table('card--cms__body table--cms', ['Date', 'Time', ''], $tourTableArray);

$cmsNotification = new cmsNotification('Error', $pageController->errors);
?>
    <div class="cms-container row">
        <nav class="breadcrumbs breadcrumbs--cms col-12">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="edit-pages.php">Edit Pages</a></li>
                <li class="breadcrumbs__breadcrumb"><a href="#">History Event</a></li>
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

                        <?php if(isset($page->image) && strlen($page->image) > 0) { ?>
                            <img src="<?php echo $page->image ?>" alt="Artist Image">
                            <input class="button button--secondary" type="submit" name="delete_image-image" value="delete image">
                            <br/><br/>
                        <?php } else { ?>
                            <p>No image present</p>
                        <?php } ?>
                        <input type="file" name="image" >
                    </fieldset>

                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">First section title</label>
                        <input placeholder="enter the title..." type="text" name="first_section_title" value="<?php echo $page->first_section_title ?? ''?>">
                    </fieldset>
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">First section text</label>
                        <textarea placeholder="enter the content..." name="first_section_text"><?php echo $page->first_section_text ?? ''; ?></textarea>
                    </fieldset>
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">First section list (seperate with ";")</label>
                        <textarea placeholder="enter the content..." name="first_section_list"><?php echo $page->first_section_list ?? ''; ?></textarea>
                    </fieldset>

                    <fieldset>
                        <label class="label">First Section Image</label>

                        <?php if(isset($page->first_section_image) && strlen($page->first_section_image) > 0) { ?>
                            <img src="<?php echo $page->first_section_image ?>" alt="Artist Image">
                            <input class="button button--secondary" type="submit" name="delete_image-first_section_image" value="delete image">
                            <br/><br/>
                        <?php } else { ?>
                            <p>No image present</p>
                        <?php } ?>
                        <input type="file" name="first_section_image">
                    </fieldset>

                    <br/>
                    <div class="col-12 row justify-content-end">
                        <input class="button" type="submit" name="submit" value="Update history page">
                    </div>
                </form>
            </article>
        </div>


        <div class="col-4">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Tours</h3>
                    <a href="tour-detail-page.php" class="button button--secondary">Add tour</a>
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
