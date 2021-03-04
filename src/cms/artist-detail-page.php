<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$artistController = new artistController();
// $artistController->getArtist();
$artist = new artist(1, "test", "bio");

/**
 * array(performance(date, time, duration, Location(name, hall)))
 * 
 */
$navigation = new cmsNavigation("Events");
$navigation->render();

$table = new table('card--cms__body table--cms', ['Date', 'Time', 'Location', 'Hall', ''], array());
$tableSongs = new table('card--cms__body table--cms', ['image', 'title', 'url', ''], array());
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
                <table class="card--cms__body table--cms">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Location</th>
                            <th>Hall</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Saturday 28 July</td>
                            <td>21.00-22.00</td>
                            <td>Patronaat</td>
                            <td>Main Hall</td>
                            <td class="table--cms__item__navigation">
                                <a href="cms/artist-performance-details.php" class="">Edit</a>
                                <a href="#" class="">Remove</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Saturday 28 July</td>
                            <td>21.00-22.00</td>
                            <td>Patronaat</td>
                            <td>Main Hall</td>
                            <td class="table--cms__item__navigation">
                                <a href="#" class="">Edit</a>
                                <a href="#" class="">Remove</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </article>

            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Songs</h3>
                    <button class="button button--secondary">Add song</button>
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
