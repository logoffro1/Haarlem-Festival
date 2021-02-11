<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/assets/styles/main.css">
    <title>CMS - Dashboard</title>
</head>

<body class="page--cms">
    <aside class="navigation--cms">
        <header class="navigation--cms__header">
            <img src="/assets/images/svg/logo.svg" alt="">
            <a href="#" class="navigation--cms__header__profile">
                <img src="" alt="">
            </a>
        </header>
        <nav class="navigation--cms__body">
            <ul>
                <li><a href="#" class="button button--cms button--active">Edit Pages</a></li>
                <li><a href="#" class="button button--cms">Events</a></li>
                <li><a href="#" class="button button--cms">Reservations</a></li>
                <li><a href="#" class="button button--cms">Invoices</a></li>
                <li><a href="#" class="button button--cms">Users</a></li>
                <li><a href="#" class="button button--cms">API</a></li>
            </ul>
        </nav>
        <footer class="navigation--cms__footer">
            <a href="#" class="button button--secondary">Log out</a>
        </footer>
    </aside>

    <section class="cms-container row">
        <nav class="breadcrumbs breadcrumbs--cms col-12">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="">Edit Pages</a></li>
                <li class="breadcrumbs__breadcrumb"><a href="">Jazz Event</a></li>
            </ul>
        </nav>

        <section class="col-8">
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
        </section>

        <section class="col-4">
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
        </section>

    </section>

    <div class="notification--cms js-notification">
        <div class="notification--cms__title">Test title</div>
        <div class="notification--cms__body">
            test content <span class="notification--cms__body__important">Bold</span>
        </div>
    </div>
    <script src="/assets/scripts/index.js"></script>
</body>
</html>