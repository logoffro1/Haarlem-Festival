<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("Events");
$navigation->render();
?>

    <div class="cms-container row">
        <nav class="breadcrumbs breadcrumbs--cms col-12">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="cms/index.php">Edit Pages</a></li>
                <li class="breadcrumbs__breadcrumb"><a href="detail-pages.php">Jazz Event</a></li>
                <li class="breadcrumbs__breadcrumb"><a href="">Gare Du Nord</a></li>
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
                        <label class="label">Adres</label>
                        <input placeholder="enter the adres..." type="text" name="adres" id="adres">
                    </fieldset>
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Biography</label>
                        <textarea placeholder="enter the content..." name="page_content" id="page_content"></textarea>
                    </fieldset>
                </form>
            </article>

            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Page Content</h3>
                    <button class="button button--secondary">Add performance</button>
                </header>
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
        </div>

        <div class="col-4">
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Details</h3>
                </header>
                <form class="card--cms__body row">
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Url</label>
                        <input placeholder="enter the url..." type="text" name="url" id="url">
                    </fieldset>
                                
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Template</label>
                        <select name="template" id="template" class="has-placeholder">
                            <option value="" disabled selected hidden>Template...</option>
                            <option value="21-3-2020">Haarlem Jazz</option>
                        </select>
                    </fieldset>
                </form>
            </article>
    
            <article class="card--cms">
                <header class="card--cms__header">
                    <h3 class="card--cms__header__title">Artists Image</h3>
                </header>
                <form class="card--cms__body table--cms">
                    <img src="" alt="Artist Image">
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
                        <input placeholder="enter the url..." type="text" name="youtube" id="youtube">
                    </fieldset>
                                
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Instagram</label>
                        <input placeholder="enter the url..." type="text" name="instagram" id="instagram">
                    </fieldset>
                                
                    <fieldset class="col-12 col--children-fullwidth">
                        <label class="label">Facebook</label>
                        <input placeholder="enter the url..." type="text" name="facebook" id="facebook">
                    </fieldset>
                </form>
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