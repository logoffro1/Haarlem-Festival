<?php
include '../classes/autoloader.php';

$head = new head("CMS - Cuisine Overview", "page--cms");
$head->render();

$navigation = new cmsNavigation("Edit Pages");
$navigation->render();

$breadcrumbsArray = array(
    array('text' => 'Edit Pages', 'url' => "index.php"),
    array('text' => 'Cuisine Event', 'url' => "#"),
);
$breadcrumbs = new breadcrumbs($breadcrumbsArray, 'breadcrumbs--cms');

$pageController = new pageController();
$page = $pageController->getPage(1);

if(isset($_POST['submit']))    
{
    $pageController->updatePage($page, 1);
}

foreach($_POST as $key => $value) {
    if (strpos($key, 'delete_image') === 0) {
        $pageController->deleteImage($page, 1, $key);
    }
}

$restaurantController = new restaurantController();
$restaurantList = $restaurantController->getRestaurants();

$tableArray = array();

foreach($restaurantList as $restaurant){
    $restaurantArray = array();
    $restaurantArray[] = $restaurant->name;
    $restaurantArray[] = "<a class='align--flex-end' href='restaurant-detail-page.php?id=$restaurant->id'>edit</a>";
  

    $tableArray[] = $restaurantArray;
};

$cmsNotification = new cmsNotification('Error', $pageController->errors);

$table = new table('card--cms__body table--cms', ['Restaurant name', ''], $tableArray);

?>
    <div class="cms-container row">
        <?php
            $breadcrumbs->render();
        ?>
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
                        <label class="label">Content</label>
                        <textarea placeholder="enter the content..." name="page_content" id="page_content"><?php echo $page->page_content ?? ''?></textarea>
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

                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Cooking styles title</label>
                        <input placeholder="enter the title..." type="text" name="first_section_title" value="<?php echo $page->first_section_title ?? ''?>">
                    </fieldset>

                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Cooking styles content</label>
                        <textarea placeholder="enter the content..." name="first_section_text"><?php echo $page->first_section_text ?? ''?></textarea>
                    </fieldset>

                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Cooking styles list (seperate with ";")</label>
                        <textarea placeholder="enter the content..." name="first_section_list"><?php echo $page->first_section_list ?? ''?></textarea>
                    </fieldset>

                    
                    <fieldset>
                        <label class="label">Cooking styles Image</label>

                        <?php if(isset($page->first_section_image) && strlen($page->first_section_image) > 0) { ?>
                            <img src="<?php echo UPLOAD_FOLDER . $page->first_section_image ?>" alt="Artist Image">
                            <input class="button button--secondary" type="submit" name="delete_image-first_section_image" value="delete image">
                            <br/><br/>
                        <?php } else { ?>
                            <p>No image present</p>
                        <?php } ?>
                        <input type="file" name="first_section_image" >
                    </fieldset>


                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Share and win title</label>
                        <input placeholder="enter the title..." type="text" name="second_section_title" value="<?php echo $page->second_section_title ?? ''?>">
                    </fieldset>

                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Share and win contest</label>
                        <textarea placeholder="enter the content..." name="second_section_text"><?php echo $page->second_section_text ?? ''?></textarea>
                    </fieldset>

                    <br/>
                    <fieldset class="col-12 row justify-content-end">
                        <input class="button" type="submit" name="submit" value="Update cuisine page">
                    </fieldset>
                </form>
            </article>
        </div>

        <div class="col-4">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Restaurants</h3>
                    <a href="restaurant-detail-page.php" class="button button--secondary">Add restaurant</a>
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
