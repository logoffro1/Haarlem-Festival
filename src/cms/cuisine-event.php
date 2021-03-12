<?php
include '../classes/autoloader.php';

$head = new head("CMS - Cuisine Overview", "page--cms");
$head->render();

$navigation = new cmsNavigation("Edit Pages");
$navigation->render();

$breadcrumbsArray = array(
    array('text' => 'Edit Pages', 'url' => "/index.php"),
    array('text' => 'Cuisine Event', 'url' => "#"),
);
$breadcrumbs = new breadcrumbs($breadcrumbsArray, 'breadcrumbs--cms');

$restaurantController = new restaurantController();
$restaurantList = $restaurantController->getRestaurants();

foreach($restaurantList as $restaurant){
    $restaurantArray[] = $restaurant->name;
    $restaurantArray[] = "<a class='align--flex-end' href='restaurant-details.php?id=$restaurant->id'>edit</a>";
  

    $restaurantList[] = $restaurantArray;
};



$table = new table('card--cms__body table--cms', ['Restaurant name', ''], $restaurantList);

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
                <form class="card--cms__body row" enctype="multipart/form-data">
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Title</label>
                        <input placeholder="enter the title..." type="text" name="title" id="title">
                    </fieldset>

                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Content</label>
                        <textarea placeholder="enter the content..." name="page_content" id="page_content"></textarea>
                    </fieldset>

                    <fieldset>
                        <label class="label">Hero Image</label>
                        <?php if(false) { ?> <!-- Todo add restaurant data in if -->
                            <img src="<?php echo UPLOAD_FOLDER; //. $song->image ?>" alt="Artist Image">
                            <br/>
                        <?php } else { ?>
                            <p>No image present</p>
                        <?php } ?>
                        <input type="file" name="image" >
                    </fieldset>

                    <br/>
                    <div class="col-12 row justify-content-end">
                        <input class="button" type="submit" name="submit" value="Update cuisine page">
                    </div>
                </form>
            </article>
        </div>

        <div class="col-4">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Restaurants</h3>
                    <button class="button button--secondary">Add restaurant</button>
                </header>
                <?php
                    $table->render();
                ?>
            </div>
        </div>

    </div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>
