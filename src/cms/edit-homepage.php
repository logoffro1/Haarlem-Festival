<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("Edit Pages");
$navigation->render();

$pageController = new pageController();
$page = $pageController->getPage(5);

if(isset($_POST['submit']))    
{
    $pageController->updatePage($page, 5);
}

$cmsNotification = new cmsNotification('Error', $pageController->errors);

?>
    <div class="cms-container row">
        <nav class="breadcrumbs breadcrumbs--cms col-12">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="edit-pages.php">Edit Pages</a></li>
                <li class="breadcrumbs__breadcrumb"><a href="#">Homepage</a></li>
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
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Page text</label>
                        <textarea placeholder="enter the content..." name="page_text"><?php echo $page->page_text ?? ''; ?></textarea>
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
                    <fieldset>
                        <label class="label">First section Image</label>

                        <?php if(!empty($page->first_section_image)) { ?>
                            <img src="<?php echo UPLOAD_FOLDER . $page->first_section_image ?>" alt="Page Image">
                            <br/>
                        <?php } else { ?>
                            <p>No image present</p>
                        <?php } ?>
                        <input type="file" name="first_section_image" >
                    </fieldset>

                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Second section title</label>
                        <input placeholder="enter the title..." type="text" name="second_section_title" value="<?php echo $page->second_section_title ?? ''; ?>">
                    </fieldset>
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Second section text</label>
                        <textarea placeholder="enter the content..." name="second_section_text"><?php echo $page->second_section_text ?? ''; ?></textarea>
                    </fieldset>
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Second section list (Seperate with ';')</label>
                        <textarea placeholder="enter the content..." name="second_section_list"><?php echo $page->second_section_list ?? ''; ?></textarea>
                    </fieldset>

                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">third section title</label>
                        <input placeholder="enter the title..." type="text" name="third_section_title" value="<?php echo $page->third_section_title ?? ''; ?>">
                    </fieldset>
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">third section text</label>
                        <textarea placeholder="enter the content..." name="third_section_text"><?php echo $page->third_section_text ?? ''; ?></textarea>
                    </fieldset>


                    <fieldset class="col-12 row justify-content-end">
                        <input class="button" type="submit" name="submit" value="Update page content">
                    </fieldset>
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
