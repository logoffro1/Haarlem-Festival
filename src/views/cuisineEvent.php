<?php
    include '../classes/autoloader.php';
    $contoller = new cuisineEventController();

    $head = new head("Cuisine Event", "");
    $head->render();

    $navigation = new navigation("Home");
    $navigation->render();
?>

<section class="container section" style="margin-top:-50px">
<pre style="letter-spacing:1px"><a href = "#">Events </a> > <a hrtef = "#"> Haarlem Cuisine</a> </pre>
<h1 class="title title--page cuisine"> The Haarlem Cuisine </h1>
<img src="../assets/images/cuisine/cuisineBanner.png" class="banner" alt="The Haarlem Festival" title="The Haarlem Cuisine">

<hr class="hLine">
<h2 style="width:55%;margin:auto;text-align:center">Pay a visit to Haarlem this year and enjoy the art of good food an drinks in one of our many special restaurants, 
     or be surprised at one of the gastronomic events that the city has to offer.
</h2>
<hr class="hLine">
<?php
//Get cuisine from DB later
$cuisines = array("All", "Dutch", "French", "Argentinian", "European", "Fish and Seafood", "Steakhouse", "Modern");
echo "<fieldset class='checkboxes--wrapper' style='text-align:center;'>";
foreach($cuisines as $cuisine){
    $checkbox = new checkbox($cuisine,$cuisine,$cuisine);
    $checkbox->render();
}
echo "</fieldset>";
?>
<hr class="hLine">
<article class = "vLine"></article>
<article class="row">
<?php

for($x = 0; $x<8;$x++){
    $card = new restaurantCard();
    $card->render();
}

//string $name, string $image, string $address, int $seats, int $stars, float $duration, array $cuisine, array $sessions
?>
</article>
</section>


<?php 
    $footer = new footer();
    $footer->renderFooter();
?>
