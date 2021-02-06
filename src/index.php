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
    <title>Document</title>
</head>

<body>
    <nav class="navigation">
        <a href="#">
            <img class="navigation__brand" src="./assets/images/svg/logo.svg"/>
        </a>
        <ul class="navigation__links">
            <li><a href="#">Home</a></li>
            <li><a href="#">Events</a></li>
            <li><a href="#">Your Programme</a></li>
        </ul>
        <div class="navigation__shop">
            <a class="icon icon--small icon--background icon--rounded" href="#">
                <span class="navigation__shop__item-count badge">1</span>
                <img src="./assets/images/svg/icons/shopping_cart-24px.svg" alt="" />
            </a>
        </div>
    </nav>

    <div class="hero hero--large" style="background-image: url('./assets/images/hero-image.png');">
        <div class="hero__body hero__body--background">
            <h1 class="hero__body__title--page">4 days of<br/>
summer & culture<br/> 
in Haarlem<br/></h1>
            <p>The Haarlem Festival is a four day festival to experience the culture of Haarlem.<br/>Enjoy different kinds of events online or offline.</p>
        </div>
    </div>
    <div class="hero hero--small hero--overlay cuisine" style="background-image: url('./assets/images/hero-image.png');">
        <div class="hero__body">
            <h1>test</h1>
            <p>test, testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest</p>
        </div>
    </div>
    <div class="container">
        <h1 class="title title--page jazz"><?php echo "home"; ?></h1>

        <!-- Testing custom column grid -->
        <div class="row">
            <div class="col-1">
                <div style="background-color:red">Test red</div>
            </div>
            <div class="col-auto">
                <div style="background-color:blue">Test blue</div>
            </div>
            <div class="col-1">
                <div style="background-color:green">Test green</div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div style="background-color:blue">Test blue</div>
            </div>
            <div class="col-6">
                <div style="background-color:green">Test green</div>
            </div>
        </div>

        <button>test</button>
        <button disabled>test</button>
        <a href="#" class="button">test</a>
        <input type="text" name="" placeholder="full name" id="">

        <button class="button--secondary">test</button>
        <select name="cars" id="cars">
            <option value="volvo">Volvo</option>
            <option value="saab">Saab</option>
            <option value="mercedes">Mercedes</option>
            <option value="audi">Audi</option>
        </select>

        <label for="1">
            <input type="checkbox" name="" id="1">
            <span>test</span>
        </label>

        <label for="2">
            <input type="radio" name="" id="2">
            <span>test</span>
        </label>

        <section>
            <ul class="steps">
                <li class="step">
                    <a href=""><span>Your Cart</span></a>
                </li>
                <li class="step step--active">
                    <a href=""><span>Personal Details</span></a>
                </li>
                <li class="step">
                    <a href=""><span>Payment</span></a>
                </li>
                <li class="step">
                    <a href=""><span>Confirmation</span></a>
                </li>
            </ul>
        </section>
    </div>
        <section class="container countdown">
            <h3 class="countdown__title title title--tetriary">Ticket sales and in:</h3>

            <p class="countdown__wrapper-text">
                <span class="countdown__counter js-countdown--days">31</span>
                <span class="title title--tetriary">Days</span>
            </p>
            <p class="countdown__wrapper-text">
                <span class="countdown__counter js-countdown--hours">14</span>
                <span class="title title--tetriary">Hours</span>
            </p>
            <p class="countdown__wrapper-text">
                <span class="countdown__counter js-countdown--minutes">10</span>
                <span class="title title--tetriary">Minutes</span>
            </p>
            <p class="countdown__wrapper-text">
                <span class="countdown__counter js-countdown--seconds">20</span>
                <span class="title title--tetriary">Seconds</span>
            </p>

            <p class="countdown__button">
                <a href="#" class="button">Create your programme</a>
            </p>
        </section>

    <footer>
        <nav class="footer__nav col-3">
            <a href="#">
                <img src="./assets/images/svg/logo-white.svg"/>
            </a>
            
            <ul class="footer__nav__list">
                <li><a href="#"><img src="./assets/images/svg/instagram.svg" alt=""></a></li>
                <li><a href="#"><img src="./assets/images/svg/facebook.svg" alt=""></a></li>
                <li><a href="#"><img src="./assets/images/svg/youtube.svg" alt=""></a></li>
            </ul>
        </nav>
        <ul class="footer__list col-2">
            <span class="footer__list__title">Events</span>
            <li><a href="#">Jazz</a></li>
            <li><a href="#">Dance</a></li>
            <li><a href="#">History</a></li>
            <li><a href="#">Cuisine</a></li>
        </ul>
        <ul class="footer__list col-2">
            <span class="footer__list__title">Pages</span>
            <li><a href="#">Your programme</a></li>
            <li><a href="#">Shopping Cart</a></li>
            <li><a href="#">Discount</a></li>
        </ul>
        <ul class="footer__list col-2"></ul>
        <ul class="footer__list col-2">
        <span class="footer__list__title">Partners with</span>

            <li><a href="#"><img src="./assets/images/svg/haarlem-city-logo.svg" alt=""></a></li>

        </ul>

    </footer>
    <script src="./assets/scripts/index.js"></script>
</body>

</html>