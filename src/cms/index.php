<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("");
$navigation->render();
?>

    <div class="cms-container">
        <nav class="breadcrumbs breadcrumbs--cms">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="">Events</a></li>
            </ul>
        </nav>
       
        <nav class="tabs--cms">
            <ul class="tabs--cms__list">
                <li><a class="is-active" href="#">Jazz</a></li>
                <li><a href="#">Dance</a></li>
                <li><a href="#">History</a></li>
                <li><a href="#">Cuisine</a></li>
            </ul>
        </nav>
        <article class="card--cms">
            <button class="button button--top">Add artist</button>
            <button class="button button--top">Add performance</button>
            <table class="card--cms__body table--cms">
                <thead>
                    <tr>
                        <th>Band</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Hall</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Gare du Nord</td>
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
                        <td>Gare du Nord</td>
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
    </div>

    <div class="notification--cms js-notification">
        <div class="notification--cms__title">Test title</div>
        <div class="notification--cms__body">
            test content <span class="notification--cms__body__important">Bold</span>
        </div>
    </div>
    <script src="./assets/scripts/index.js"></script>
</body>
</html>