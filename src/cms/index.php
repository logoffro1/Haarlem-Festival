<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./assets/styles/main.css">
    <title>CMS - Dashboard</title>
</head>

<body class="page--cms">
    <aside class="navigation--cms">
        <header class="navigation--cms__header">
            <img src="./assets/images/svg/logo.svg" alt="">
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

    <section class="cms-container">
        <nav class="breadcrumbs breadcrumbs--cms">
            <ul>
                <li class="breadcrumbs__breadcrumb"><a href="">Home</a></li>
                <li class="breadcrumbs__breadcrumb"><a href="">Edit Pages</a></li>
            </ul>
        </nav>
       
        <article class="card--cms">
            <header class="card--cms__header">
                <h3 class="card--cms__header__title">Event Details</h3>
                <a href="#" class="button button--secondary">Add new artist</a>
            </header>
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
                            <a href="#" class="">Edit</a>
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

        <nav class="tabs--cms">
            <ul class="tabs--cms__list">
                <li><a class="is-active" href="#">Jazz</a></li>
                <li><a href="#">Dance</a></li>
                <li><a href="#">History</a></li>
                <li><a href="#">Cuisine</a></li>
            </ul>
        </nav>
        <article class="card--cms">

            <div class="card--cms__body">
                test
            </div>
        </article>
    </section>

    <div class="notification--cms js-notification">
        <div class="notification--cms__title">Test title</div>
        <div class="notification--cms__body">
            test content <span class="notification--cms__body__important">Bold</span>
        </div>
    </div>
    <script src="./assets/scripts/index.js"></script>
</body>
</html>