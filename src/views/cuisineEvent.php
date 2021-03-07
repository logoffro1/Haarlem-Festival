<?php
    include '../classes/autoloader.php';
    $contoller = new cuisineEventController();
    $restaurantTypeController = new restaurantTypeController();
    $restaurantController = new restaurantController();
    $restaurants = $restaurantController->getRestaurants();
    $head = new head("Cuisine Event", "");
    $head->render();

    $navigation = new navigation("");
    $navigation->render();
    
?>
<section class="container section" style="margin-top:-50px;">
    <pre style="letter-spacing:1px"><a href = "#">Events </a> > <a href = "#"> Haarlem Cuisine</a> </pre>
    <h1 class="title title--page cuisine"> The Haarlem Cuisine </h1>
    <img src="../assets/images/cuisine/cuisineBanner.png" class="banner" alt="The Haarlem Festival"
        title="The Haarlem Cuisine">

    <hr class="hLine">
    <h2 style="width:55%;margin:auto;text-align:center">Pay a visit to Haarlem this year and enjoy the art of good food
        an drinks in one of our many special restaurants,
        or be surprised at one of the gastronomic events that the city has to offer.
    </h2>
    <hr class="hLine">
    <?php
        $cuisines = $restaurantTypeController->getRestaurantTypes();
echo "<fieldset class='checkboxes--wrapper' style='text-align:center;'>";
$checkbox = new checkbox("All","All","All",true);
$checkbox->render();
foreach($cuisines as $cuisine){
    $checkbox = new checkbox($cuisine->__get('name'),$cuisine->__get('name'),$cuisine->__get('name'));
    $checkbox->render();
}
echo "</fieldset>";
?>
    <hr class="hLine">
    <article class="vLine"></article>
    <article class="row">
        <?php


foreach($restaurants as $r){
    $card = new restaurantCard($r->__get('name'),
    "..".$r->__get('images')[0],
    $r->__get('address'),
    $r->__get('seats'),
    $r->__get('stars'),
    $r->__get('duration'),
    $r->__get('cuisines'),
    $r->getSessions());

    $card->render();
}
?>
    </article>
    <section class="cookbook-outer-area">
        <section class="cookbook-inner-area">
            <article class="leftContainer">
                <h1 class="title title--page cuisine">Cook like a Chef</h1>
                <pre class="cookbook--description">Want to become a chef yourself, or are you ready for
something new? Try out our new cookbook!
Checkout a wide array of diverse recipes, made by the chefs
of the Haarlem Festival.
            </pre>
            <button>Download the cookbook</button>
                
            </article>
            <article class="rightContainer">
                <h2>Cooking Styles</h2>
                <pre><span class = "bullet">&#8226</span> French               <span class = "bullet">&#8226</span> Fish and Seafood
<span class = "bullet">&#8226</span> Vegan                <span class = "bullet">&#8226</span> Favorites of the Chefs
<span class = "bullet">&#8226</span> European
<span class = "bullet">&#8226</span> Modern
<span style = "font-weight:600;">And many more! </span>
                </pre>

            </article>
            <img src="../assets/images/cuisine/cookbookImg.png" class="cookbook--image">
        </section>
    </section>
    <img src="../assets/images/cuisine/shareandwin.png" class="shareandwin">
    </section>
    



<?php 
    $footer = new footer();
    $footer->renderFooter();
?>