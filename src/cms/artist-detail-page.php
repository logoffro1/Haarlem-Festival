<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();


$artistController = new artistController();

$artist = null;
$idExist = isset($_GET['id']);
if($idExist)    
{
    $artist = $artistController->getArtist();
    $artistController->createSession($artist);

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

    $table = new table('card--cms__body table--cms', ['Date', 'Time', 'Location', ''], $performances);
    $tableSongs = new table('card--cms__body table--cms', ['title', 'image', 'url', ''], $songs);
    
}

if(isset($_GET['event'])){
    $eventId = (int)$_GET['event'];
} 

if(isset($_POST['add']))    
{
    $artistController->addArtist();
}

if(isset($_GET['delete']))    
{
    $artistController->deleteArtist();
}

if($idExist && isset($_POST['content']) || isset($_POST['social']))    
{
    $artistController->updateArtist($artist);
}
if($idExist && isset($_POST['update_image']))    
{
    $artistController->updateArtistImage($artist);
}
if($idExist && isset($_POST['delete_image']))    
{
    $artistController->deleteArtistImage($artist);
}


$navigation = new cmsNavigation("Events");
$navigation->render();

$cmsNotification = new cmsNotification('Error', $artistController->errors);
?>
    <div class="cms-container row">
        <nav class="breadcrumbs breadcrumbs--cms col-12">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="edit-pages.php">Edit Pages</a></li>
                <li class="breadcrumbs__breadcrumb"><a href=""><?php echo $artist->name ?? 'New Artist'; ?></a></li>
            </ul>
        </nav>

        <div class="col-8">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Artist Name</h3>
                    <?php
                        if($idExist){
                    ?>
                        <a class="button button--secondary" href="artist-detail-page.php?id=<?php echo $artist->id ?>&delete=<?php echo $artist->id ?>">Delete artist</a>
                    <?php
                        }
                    ?>
                </header>
                <form class="card--cms__body row" method="post">
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Name</label>
                        <input placeholder="enter the title..." type="text" name="title" id="title" value="<?php echo $artist->name ?? ''; ?>">
                    </fieldset>
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Biography</label>
                        <textarea placeholder="enter the content..." name="page_content" id="page_content" ><?php echo $artist->biography ?? ''; ?></textarea>
                    </fieldset>

                    <fieldset class="col-12 row justify-content-end">
                        <?php if($idExist){
                            echo '<input type="submit" name="content" value="Update content" class="button">';
                        } else {
                            echo '<input class="button" type="submit" name="add" value="Create new artist">';
                            echo '<div class="col-12 row justify-content-end text-align--right">
                                <p>When creating a new artist,<br/>add the name and biography before adding other content.</p>
                            </div>';
                        } 
                        ?>
                    </fieldset>
                </form>
            </article>

            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Performances</h3>
                    <?php if($idExist){ ?>
                        <a href="artist-performance-details.php?event=<?php echo $eventId; ?>" class="button button--secondary">Add performance</a>
                    <?php } ?>
                </header>

                <?php
                if(isset($table)){
                    $table->render();
                }
                ?>
            </article>

            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Songs</h3>
                    <?php if($idExist){ ?>
                            <a class="button button--secondary" href="artist-songs.php">Add song</a>
                    <?php } ?>
                </header>

                <?php
                if(isset($tableSongs)){
                    $tableSongs->render();
                }
                ?>
            </article>
        </div>

        <div class="col-4">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Artists Image</h3>
                </header>
                <form class="card--cms__body table--cms" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <?php if(strlen($artist->image) > 0) { ?>
                            <img src="<?php echo UPLOAD_FOLDER.$artist->image ?? ''; ?>" alt="Artist Image">
                            <br/>
                        <?php } else { ?>
                            <p>No image present</p>
                        <?php } ?>
                        <input type="file" name="artist_image">
                    </fieldset>

                    <?php if($idExist){ ?>
                        <input class="button" type="submit" name="update_image" value="Update image">
                        <input class="button button--secondary" type="submit" value="Delete image" name="delete_image">
                    <?php } ?>

                </form>
            </article>
            
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Social Media</h3>
                </header>
                <form class="card--cms__body row" method="post">
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Youtube</label>
                        <input placeholder="YouTube channel..." type="text" name="youtube" id="youtube" value="<?php echo $artist->youtube ?? ''; ?>">
                    </fieldset>
                                
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Instagram</label>
                        <input placeholder="Instagram account..." type="text" name="instagram" id="instagram" value="<?php echo $artist->instagram ?? ''; ?>">
                    </fieldset>
                                
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Facebook</label>
                        <input placeholder="Facebook page..." type="text" name="facebook" id="facebook" value="<?php echo $artist->facebook ?? ''; ?>">
                    </fieldset>
                                
                    <fieldset class="col-12">
                        <?php if($idExist){ ?>
                            <input type="submit" name="social" value="Update social media" class="button">
                        <?php } ?>
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
