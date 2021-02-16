<?php
include './classes/autoloader.php';



$head = new head("homepage");
$head->render();

?>

<?php 
$navigation = new navigation("Home");
$navigation->render();
?>

<?php 
    $hero = new hero(
        "hero--large", 
        "4 days of<br/>summer & culture<br/> in Haarlem<br/>", 
        "The Haarlem Festival is a four day festival to experience the culture of Haarlem.<br/>Enjoy different kinds of events online or offline.", 
        "./assets/images/hero-image.png"
    );

    $hero->render();
?>


<!-- 
    <div class="hero hero--large" style="background-image: url('./assets/images/hero-image.png');">
        <div class="hero__body hero__body--background">
            <h1 class="hero__body__title--page">
                4 days of<br/>
                summer & culture<br/> 
                in Haarlem<br/>
            </h1>
            <p>The Haarlem Festival is a four day festival to experience the culture of Haarlem.<br/>Enjoy different kinds of events online or offline.</p>
        </div>
    </div> -->

    <section class="container section">
        <article class="row align-items-center">
            <header class="col-5">
                <h1 class="title title--page dance"><?php echo "Experience Haarlem Together"; ?></h1>
                <p>The Haarlem festival is more than just a festival. It is <br/> an environment where you can enjoy a wide variety of <br/>events with friends, family, or people u have just met. <br/>About the same interests or even topics you do not<br/> know anything about.</p>
            </header>
            <img class="col-5 col-offset-1" src="./assets/images/home_image-1.png" alt="">
        </article>
    </section>

    <section class="container section section--background">
        <article class="row align-items-center">
            <header class="col-5 col-offset-1">
                <h1 class="title title--page history"><?php echo "Corona safety measurments"; ?></h1>
                <p>
                The safety during our festival is one of our top
                priorities, to make sure everyone has a safe and exciting time during all the events.
                <br/><br/>
                That is why we have setup a list of safety measurements to make sure of this.
                </p>
            </header>
            <ul class="col-5 col-offset-1 ul--disc ul--large-margin">
                <li>Please stay home if you show sympthoms related to the Corona virus.</li>
                <li>Visitors above the age of twelve are required to wear a mask.</li>
                <li>If you are waiting in a queue, please enforce the 1.5 meter distance rule</li>
            </ul>
        </article>
    </section>

    
    <section class="container section">
        <article class="row align-items-center">
            <header class="col-4">
                <h1 class="title title--page dance"><?php echo "26 - 29 July<br/>The Best Events"; ?></h1>
                <p>
                    Enjoy our four day culture festival Online and Offline.
                    <br/>
                    <br/>
                    Get inspired by multiple events over the days
                    and meet new people with the same interests.
                    <br/>
                    <br/>
                    Create your programme consisting of multiple events
                    Spread over one or even four days!
                </p>
                <a href="#" class="button">Create your programme</a>
            </header>
            <section class="row col-7 col-offset-1">
                <?php
                    $cuisineEvent = new eventCards("cuisine", "get inspired by", "The haarlem cuisine", "#");
                    $historyEvent = new eventCards("history", "Discover", "The haarlem history", "#");
                    $danceEvent = new eventCards("dance", "Get wild during", "The haarlem dance", "#");
                    $jazzEvent = new eventCards("jazz", "Check out", "The haarlem jazz", "#");

                    $cuisineEvent->render();
                    $historyEvent->render();
                    $danceEvent->render();
                    $jazzEvent->render();
                ?>
            </section>
        </article>
    </section>
<!--
    <div class="hero hero--small hero--overlay cuisine" style="background-image: url('./assets/images/hero-image.png');">
        <div class="hero__body">
            <h1>test</h1>
            <p>test, testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest</p>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-1 col-offset-3">
                <div style="background-color:red">Test red</div>
            </div>
            <div class="col-5">
                <div style="background-color:blue">Test blue</div>
            </div>
            <div class="col-3">
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




    </div>

   
-->

    <section class="countdown js-countdown section section--background" end-date="2021-05-13">
        <h3 class="countdown__title title title--tetriary">Ticket sales and in:</h3>

        <p class="countdown__wrapper-text">
            <span class="countdown__counter js-countdown__days">00</span>
            <span class="title title--tetriary">Days</span>
        </p>
        <p class="countdown__wrapper-text">
            <span class="countdown__counter js-countdown__hours">00</span>
            <span class="title title--tetriary">Hours</span>
        </p>
        <p class="countdown__wrapper-text">
            <span class="countdown__counter js-countdown__minutes">00</span>
            <span class="title title--tetriary">Minutes</span>
        </p>
        <p class="countdown__wrapper-text">
            <span class="countdown__counter js-countdown__seconds">00</span>
            <span class="title title--tetriary">Seconds</span>
        </p>

        <p class="countdown__button">
            <a href="#" class="button">Create your programme</a>
        </p>
    </section>

<?php
    $footer = new footer();
    $footer->render();

?>