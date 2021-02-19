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
                <button class="button">Add page</button>
            </header>
            <table class="card--cms__body table--cms">
                <tbody>
                    <tr>
                        <td>Homepage</td>
                        <td class="table--cms__item__navigation">
                            <a href="#" class="">Edit</a>
                            <a href="#" class="">Remove</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Jazz event page</td>
                        <td class="table--cms__item__navigation">
                            <a href="cms/detail-pages.php" class="">Edit</a>
                            <a href="#" class="">Remove</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </article>
    </div>

    <div class="notification--cms js-notification">
        <div class="notification--cms__title">Test title</div>
        <div class="notification--cms__body">
            test content <span class="notification--cms__body__important">Bold</span>
        </div>
    </div>
    <script src="/assets/scripts/index.js"></script>
</body>
</html>