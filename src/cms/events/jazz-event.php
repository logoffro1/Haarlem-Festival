<?php
include '../../classes/autoloader.php';

$editPagesController = new editPagesController();
$pagesList = $editPagesController->getPagesList();

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("Edit Pages");
$navigation->render();

?>
    <div class="cms-container row">
        <nav class="breadcrumbs breadcrumbs--cms col-12">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="edit-pages.php">Edit Pages</a></li>
                <li class="breadcrumbs__breadcrumb"><a href="#">Jazz Event</a></li>
            </ul>
        </nav>

        <div class="col-8">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Page Title</h3>
                </header>
                <form class="card--cms__body row">
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Title</label>
                        <input placeholder="enter the title..." type="text" name="title" id="title">
                    </fieldset>
                </form>
            </article>

            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Page Content</h3>
                </header>
                <form class="card--cms__body row">
                    <fieldset class="col-12 col--children-fullwidth">
                        <textarea placeholder="enter the content..." name="page_content" id="page_content"></textarea>
                    </fieldset>
                </form>
            </article>
        </div>

        <div class="col-4">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Artists</h3>
                    <button class="button button--secondary">Add artist</button>
                </header>
                <table class="card--cms__body table--cms">
                    <thead>
                        <tr>
                            <th>Band</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Gare du Nord</td>
                            <td class="table--cms__item__navigation">
                                <a href="artist-performance-details.php" class="">Edit</a>
                                <a href="#" class="">Remove</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Gare du Nord</td>
                            <td class="table--cms__item__navigation">
                                <a href="#" class="">Edit</a>
                                <a href="#" class="">Remove</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>
