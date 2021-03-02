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


<section class = "card--container">

<h1 style="margin-bottom:0px">Restaurant Mr. & Mrs.</h1>

<h3 style="margin-bottom:0px;margin-top:3px;">
<img src="../assets/images/cuisine/foodIcon.svg" class = "card--foodicon">
Dutch &#8226 European &#8226 Fish and Seafood</h3>
<a href = "#">
<section class = "card--restaurant">
<img src="../assets/images/cuisine/ratatouille.jpg" class = "card--img">

<article class="right--container">
    <img src="../assets/images/cuisine/homeIcon.svg" class = "card--homeicon">
<pre class = "card--address">Lange Veerstraat 4,
2011 DB Haarlem
</pre>
<pre class = "card--sessions"><span style="font-weight: 900;letter-spacing: 3px;">Sessions</span>
18:00-19:30
          &#8226
19:30-21:00
          &#8226
21:00-22:30
</pre>
<fieldset class = "card--stars">
<img src="../assets/images/cuisine/starFilled.png" alt="">
<img src="../assets/images/cuisine/starFilled.png" alt="">
<img src="../assets/images/cuisine/starFilled.png" alt="">
<img src="../assets/images/cuisine/starFilled.png" alt="">
<img src="../assets/images/cuisine/starEmpty.png" alt="">
</fieldset>
<fieldset class = "card--duration">
    1.5 h
    <img src="../assets/images/cuisine/clockIcon.png" alt="">
</fieldset>
<fieldset class = "card--seats">
    40
    <img src="../assets/images/svg/icons/people-24px.svg" alt="">
</fieldset>
<img src="../assets/images/cuisine/arrowIcon.png" class = "card--arrow">
<img src="../assets/images/cuisine/orangeSwoosh.png" class = "card--swoosh">
</article>


</section>
</a>
</section>
</section>


<?php 
    $footer = new footer();
    $footer->renderFooter();
?>
