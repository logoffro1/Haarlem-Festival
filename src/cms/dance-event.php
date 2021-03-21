<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("Edit Pages");
$navigation->render();

$pageController = new pageController();
$page = $pageController->getPage(2);

if(isset($_POST['submit']))    
{
    $pageController->updatePage($page, 2);
}

$cmsNotification = new cmsNotification('Error', $pageController->errors);

$artistController = new artistController();
$artistList = $artistController->getDanceArtistList();


$artistTableArray = array();

foreach ($artistList as $artist) {
    $artistArray = array();
    $artistArray[] = $artist->name;
    $artistArray[] = "<a class='align--flex-end' href='artist-detail-page.php?event=2&id=$artist->id'>edit</a>";

    $artistTableArray[] = $artistArray;
}

$table = new table('card--cms__body table--cms', ['name', ''], $artistTableArray);
?>
    <div class="cms-container row">
        <nav class="breadcrumbs breadcrumbs--cms col-12">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="edit-pages.php">Edit Pages</a></li>
                <li class="breadcrumbs__breadcrumb"><a href="#">Dance Event</a></li>
            </ul>
        </nav>

        <div class="col-8">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Page Content</h3>
                </header>
                <form class="card--cms__body row" method="POST" enctype="multipart/form-data">
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Page title</label>
                        <input placeholder="enter the title..." type="text" name="page_title" value="<?php echo $page->page_title ?? ''; ?>">
                    </fieldset>
                    <fieldset>
                        <label class="label">Page Image</label>

                        <?php if(!empty($page->page_image)) { ?>
                            <img src="<?php echo UPLOAD_FOLDER . $page->page_image ?>" alt="Page Image">
                            <br/>
                        <?php } else { ?>
                            <p>No image present</p>
                        <?php } ?>
                        <input type="file" name="page_image" >
                    </fieldset>

                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">First section title</label>
                        <input placeholder="enter the title..." type="text" name="first_section_title" value="<?php echo $page->first_section_title ?? ''; ?>">
                    </fieldset>
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">First section text</label>
                        <textarea placeholder="enter the content..." name="first_section_text"><?php echo $page->first_section_text ?? ''; ?></textarea>
                    </fieldset>

                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Hero title</label>
                        <input placeholder="enter the title..." type="text" name="hero_title" value="<?php echo $page->hero_title ?? ''; ?>">
                    </fieldset>
                    <fieldset>
                        <label class="label">Hero Image</label>

                        <?php if(!empty($page->hero_image)) { ?>
                            <img src="<?php echo UPLOAD_FOLDER . $page->hero_image ?>" alt="Hero Image">
                            <br/>
                        <?php } else { ?>
                            <p>No image present</p>
                        <?php } ?>
                        <input type="file" name="hero_image" >
                    </fieldset>

                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Second section title</label>
                        <input placeholder="enter the title..." type="text" name="second_section_title" value="<?php echo $page->second_section_title ?? ''; ?>">
                    </fieldset>
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Second section text</label>
                        <textarea placeholder="enter the content..." name="second_section_text"><?php echo $page->second_section_text ?? ''; ?></textarea>
                    </fieldset>

                    <fieldset class="col-12 row justify-content-end">
                        <input class="button" type="submit" name="submit" value="Update page content">
                    </fieldset>
                </form>
            </article>
        </div>

        <div class="col-4">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Artists</h3>
                    <a href="artist-detail-page.php?event=2" class="button button--secondary">Add artist</a>
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
