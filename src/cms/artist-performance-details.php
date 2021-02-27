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
    <title>CMS - Artist Performance Details</title>
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
                <li class="breadcrumbs__breadcrumb"><a href="edit-pages.php">Events</a></li>
                <li class="breadcrumbs__breadcrumb"><a href="#">The Family XL</a></li>
            </ul>
        </nav>
       
        <article class="card--cms col-8">
            <header class="card--cms__header">
                <h3 class="card--cms__header__title">Event Details</h3>
            </header>
            <form class="card--cms__body row">
                <p class="card--cms__body__form-title col-12">Artist</p>

                <fieldset class="col-6 col--children-fullwidth">
                    <label class="label">Band</label>
                    <select name="artist" id="artist">
                        <option selected value="Family XL">Family XL</option>
                    </select>
                </fieldset>

                <fieldset class="col-6 col--children-fullwidth">
                    <label class="label">Special Guest</label>
                    <select name="special_guest" id="special_guest" class="has-placeholder">
                        <option value="" disabled selected hidden>Special Artist/Band...</option>
                        <option value="Family XL">Family XL</option>
                    </select>
                </fieldset>

                <p class="card--cms__body__form-title col-12">Date and time</p>
                
                <fieldset class="col-6 col--children-fullwidth">
                    <label class="label">Date</label>
                    <select name="Date" id="Date" class="has-placeholder">
                        <option value="" disabled selected hidden>Date...</option>
                        <option value="21-3-2020">21-03-2020</option>
                    </select>
                </fieldset>

                <fieldset class="col-6 col--children-fullwidth">
                    <label class="label">Start time</label>
                    <input type="time" name="start_time" id="start_time">
                </fieldset>

                <fieldset class="col-6 col--children-fullwidth">
                    <label class="label">Duration (in hours)</label>
                    <input type="number" name="duration" id="duration">
                </fieldset>

                <p class="card--cms__body__form-title col-12">Location and tickets</p>
                
                <fieldset class="col-6 col--children-fullwidth">
                    <label class="label">Location</label>
                    <select name="location" id="location" class="has-placeholder">
                        <option value="" disabled selected hidden>Location...</option>
                        <option value="patronaat">Patronaat</option>
                    </select>
                </fieldset>

                <fieldset class="col-6 col--children-fullwidth">
                    <label class="label">Hall</label>
                    <select name="hall" id="hall" class="has-placeholder">
                        <option value="" disabled selected hidden>Hall...</option>
                        <option value="patronaat">Main Hall</option>
                    </select>
                </fieldset>

                <fieldset class="col-6 col--children-fullwidth">
                    <label class="label">Seats*</label>
                    <input disabled value="200" type="number" name="seats" id="seats">
                </fieldset>

                <fieldset class="col-6 col--children-fullwidth">
                    <label class="label">Price per ticket (in euro's)*</label>
                    <input disabled value="12.50" type="number" name="price" id="price">
                </fieldset>

                <p class="card--cms__body__additional">*You do not have the rights to change the Seats and Price Per Ticket.</p>
            </form>
        </article>
        <article class="card--cms col-4">
            <header class="card--cms__header">
                <h3 class="card--cms__header__title">Swap Events</h3>
            </header>
            <form class="card--cms__body row">
                <p class="card--cms__body__form-title col-12">Select date and Artist</p>

                <fieldset class="col-12 col--children-fullwidth">
                    <label class="label">Performance Date</label>
                    <select name="performance_date" id="performance_date" class="has-placeholder">
                        <option value="" disabled selected hidden>Select option...</option>
                        <option value="21-3-2020">21-03-2020</option>
                    </select>
                </fieldset>

                <fieldset class="col-12 col--children-fullwidth">
                    <label class="label">Artist/Band</label>
                    <select name="artist" id="artist" class="has-placeholder">
                        <option value="" disabled selected hidden>Select option...</option>
                        <option value="Family XL">Family XL</option>
                    </select>
                </fieldset>

                <div class="card--cms__body__results js-card--cms-input-results">
                    <p class="card--cms__body__form-title col-12">Swap events with:</p>
                    <ul>
                        <li><span class="has-font-weight-semibold">Artist/Band:</span> Artist value</li>
                        <li><span class="has-font-weight-semibold">Date:</span> Date value</li>
                        <li><span class="has-font-weight-semibold">Time:</span> Time value</li>
                        <li><span class="has-font-weight-semibold">Location:</span> Location value</li>
                    </ul>

                    <button class="button">Swap slots</button>
                </div>
            </form>
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