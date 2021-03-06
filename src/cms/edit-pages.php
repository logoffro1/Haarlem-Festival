<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("Edit Pages");
$navigation->render();

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

            <table class="card--cms__body table--cms">
                <tbody>
                    <tr>
                        <td>Homepage</td>
                        <td class="table--cms__item__navigation">
                            <a href="edit-homepage.php" class="">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Dance event page</td>
                        <td class="table--cms__item__navigation">
                            <a href="dance-event.php" class="">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Cuisine event page</td>
                        <td class="table--cms__item__navigation">
                            <a href="cuisine-event.php" class="">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Jazz event page</td>
                        <td class="table--cms__item__navigation">
                            <a href="jazz-event.php" class="">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>History event page</td>
                        <td class="table--cms__item__navigation">
                            <a href="history-event.php" class="">Edit</a>
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
