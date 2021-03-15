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

                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">First section title</label>
                        <input placeholder="enter the title..." type="text" name="first_section_title" value="<?php echo $page->first_section_title ?? ''?>">
                    </fieldset>
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">First section text</label>
                        <textarea placeholder="enter the content..." name="first_section_text"><?php echo $page->first_section_text ?? ''; ?></textarea>
                    </fieldset>

                    <fieldset>
                        <label class="label">Hero Image</label>

                        <?php if(!empty($page->image)) { ?>
                            <img src="<?php echo UPLOAD_FOLDER . $page->image ?>" alt="Artist Image">
                            <br/>
                        <?php } else { ?>
                            <p>No image present</p>
                        <?php } ?>
                        <input type="file" name="image" >
                    </fieldset>

                    <br/>
                    <div class="col-12 row justify-content-end">
                        <input class="button" type="submit" name="submit" value="Update history page">
                    </div>
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
