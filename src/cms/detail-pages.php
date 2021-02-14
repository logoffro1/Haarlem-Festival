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

    <div class="notification--cms js-notification">
        <div class="notification--cms__title">Test title</div>
        <div class="notification--cms__body">
            test content <span class="notification--cms__body__important">Bold</span>
        </div>
    </div>
    <script src="/assets/scripts/index.js"></script>
</body>
</html>