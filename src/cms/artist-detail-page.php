<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$artistController = new artistController();

$artist = $artistController->getArtist();
// var_dump($artist);
$songs = array(); 
$performances = array(); 

foreach($artist->songs as $song){
    $songArray = $song->mutateToArray();
    $songArray[] = "<a href='artist-songs.php?id=$song->id'>edit</a>";
    $songs[] = $songArray;
};

foreach($artist->performances as $performance){
    $performanceArray = $performance->mutateToArray();
    $performanceArray[] = "<a href='artist-performance-details.php?id=$performance->id'>edit</a>";
  
    $performanceArray['location'] = $performanceArray['location']->name;
    unset($performanceArray['tickets']);
    unset($performanceArray['duration']);
    $performances[] = $performanceArray;
};


$navigation = new cmsNavigation("Events");
$navigation->render();

$table = new table('card--cms__body table--cms', ['Date', 'Time', 'Location', ''], $performances);
$tableSongs = new table('card--cms__body table--cms', ['title', 'image', 'url', ''], $songs);
?>
    <div class="cms-container row">
        <nav class="breadcrumbs breadcrumbs--cms col-12">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="cms/index.php">Edit Pages</a></li>
                <li class="breadcrumbs__breadcrumb"><a href="detail-pages.php">Jazz Event</a></li>
                <li class="breadcrumbs__breadcrumb"><a href=""><?php echo $artist->name; ?>  Gare Du Nord</a></li>
            </ul>
        </nav>

        <div class="col-8">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Artist Name</h3>
                </header>
                <form class="card--cms__body row">
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Name</label>
                        <input placeholder="enter the title..." type="text" name="title" id="title" value="<?php echo $artist->name ?>">
                    </fieldset>
                </form>
            </article>

            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Biography Content</h3>
                </header>
                <form class="card--cms__body row">
                    <fieldset class="col-12 col--children-fullwidth">
                        <textarea placeholder="enter the content..." name="page_content" id="page_content" ><?php echo $artist->biography ?></textarea>
                    </fieldset>
                </form>
            </article>

            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Performances</h3>
                    <button class="button button--secondary">Add performance</button>
                </header>

                <?php
                    $table->render();
                ?>
            </article>

            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Songs</h3>
                    <a class="button button--secondary" href="artist-songs.php">Add song</a>
                </header>

                <?php
                    $tableSongs->render();
                ?>
            </article>
        </div>

        <div class="col-4">
            <article class="card--cms">
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
            
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Social Media</h3>
                </header>
                <form class="card--cms__body row">
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Youtube</label>
                        <input placeholder="YouTube channel..." type="text" name="youtube" id="youtube" value="<?php echo $artist->youtube ?>">
                    </fieldset>
                                
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Instagram</label>
                        <input placeholder="Instagram account..." type="text" name="instagram" id="instagram" value="<?php echo $artist->instagram ?>">
                    </fieldset>
                                
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Facebook</label>
                        <input placeholder="Facebook page..." type="text" name="facebook" id="facebook" value="<?php echo $artist->facebook ?>">
                    </fieldset>
                </form>
            </article>
        </div>

    </div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>
