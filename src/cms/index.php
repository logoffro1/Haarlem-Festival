<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("Events");
$navigation->render();
?>

    <div class="cms-container">
        <nav class="breadcrumbs breadcrumbs--cms">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="">Events</a></li>
            </ul>
        </nav>
       
        <div class="js-tabs">
            <nav class="tabs--cms js-tabs-navigation">
                <ul class="tabs--cms__list">
                    <li><a data-content="jazz" class="is-active" href="#">Jazz</a></li>
                    <li><a data-content="dance" href="#">Dance</a></li>
                    <li><a data-content="history" href="#">History</a></li>
                    <li><a data-content="cuisine" href="#">Cuisine</a></li>
                </ul>
            </nav>
            <article data-content="jazz" class="card--cms js-tab-content is-active">
                <button class="button button--top">Add artist</button>
                <button class="button button--top">Add performance</button>
                <?php
                    $tableHeader = array('Band', 'Date', 'Time', 'Location', 'Hall');
                    $tableBody = array(
                        array(
                            'Gare du Nord',
                            'Saturday 28 July',
                            '21.00-22.00',
                            'Patronaat',
                            'Main Hall',
                            '<div class="table--cms__item__navigation">
                            <a href="#" class="">Edit</a>
                            <a href="#" class="">Remove</a>
                            </div>'
                        ),
                        array(
                            'Gare du Nord',
                            'Saturday 28 July',
                            '21.00-22.00',
                            'Patronaat',
                            'Main Hall',
                            '<div class="table--cms__item__navigation">
                            <a href="#" class="">Edit</a>
                            <a href="#" class="">Remove</a>
                            </div>'
                        ),
                    );

                    $table = new table('card--cms__body table--cms', $tableHeader, $tableBody);
                    $table->render();
                ?>

            </article>
            <article data-content="dance" class="card--cms js-tab-content">
                <button class="button button--top">Add artist</button>
                <button class="button button--top">Add performance</button>
                <?php
                    $tableHeader = array('Band', 'Date', 'Time', 'Location', 'Hall');
                    $tableBody = array(
                        array(
                            'Gare du Nord',
                            'Saturday 28 July',
                            '21.00-22.00',
                            'Patronaat',
                            'Main Hall',
                            '<div class="table--cms__item__navigation">
                            <a href="#" class="">Edit</a>
                            <a href="#" class="">Remove</a>
                            </div>'
                        ),
                        array(
                            'Gare du Nord',
                            'Saturday 28 July',
                            '21.00-22.00',
                            'Patronaat',
                            'Main Hall',
                            '<div class="table--cms__item__navigation">
                            <a href="#" class="">Edit</a>
                            <a href="#" class="">Remove</a>
                            </div>'
                        ),
                    );

                    $table = new table('card--cms__body table--cms', $tableHeader, $tableBody);
                    $table->render();
                ?>

            </article>
        </div>
        
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