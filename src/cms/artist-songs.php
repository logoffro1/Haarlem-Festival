<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$artistController = new artistController();
// $artistController->getArtist();
$artist = new artist(1, "test", "bio");

$navigation = new cmsNavigation("Events");
$navigation->render();
?>
 <div class="cms-container row">
    <nav class="breadcrumbs breadcrumbs--cms col-12">
        <ul>
            <li class="breadcrumbs__breadcrumb"><a href="edit-pages.php">Events</a></li>
            <li class="breadcrumbs__breadcrumb"><a href="#">The Family XL</a></li>
        </ul>
    </nav>

    
    <article class="card--cms col-8">
        <header class="card--cms__header">
            <h3 class="card--cms__header__title">Song Details</h3>
        </header>
        <form class="card--cms__body row">
            <p class="card--cms__body__form-title col-12">Song</p>

            <fieldset class="col-12 col--children-fullwidth">
                <label class="label">Song title</label>
                <input placeholder="Title..." type="text" name="title" id="title">
            </fieldset>
            <fieldset class="col-12 col--children-fullwidth">
                <label class="label">Song url</label>
                <input placeholder="Url..." type="text" name="url" id="url">
            </fieldset>
        </form>
        
    </article>
    <article class="card--cms col-8">
        <header class="card--cms__header">
            <h3 class="card--cms__header__title">Artists Image</h3>
        </header>
        <form class="card--cms__body table--cms">
            <img src="<?php echo $artist->image ?>" alt="Artist Image">
            <br/>
            <button class="button">Upload Image</button>
            <button class="button button--secondary">Delete</button>
        </form>
    </article>
</div>
    
<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>