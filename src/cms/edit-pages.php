<?php
include '../classes/autoloader.php';

$editPagesController = new editPagesController();
$pagesList = $editPagesController->getPagesList();

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("Edit Pages");
$navigation->render();

$table = new table('card--cms__body table--cms', array(), $pagesList);
?>

    <div class="cms-container row">
        <nav class="breadcrumbs breadcrumbs--cms col-12">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="">Edit Pages</a></li>
            </ul>
        </nav>

        <article class="card--cms col-8">
            <header class="card--cms__header">
                <h3 class="card--cms__header__title">Pages</h3>
            </header>

            <?php $table->render(); ?>

            <table class="card--cms__body table--cms">
                <tbody>
                    <tr>
                        <td>Homepage</td>
                        <td class="table--cms__item__navigation">
                            <a href="#" class="">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Jazz event page</td>
                        <td class="table--cms__item__navigation">
                            <a href="cms/detail-pages.php" class="">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </article>
    </div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>
