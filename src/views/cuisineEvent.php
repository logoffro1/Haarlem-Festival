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
    if($cuisine == "All")
    $checkbox = new checkbox($cuisine,$cuisine,$cuisine,true);
    else
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
    $card = new restaurantCard("Restaurant Mr. & Mrs.","../assets/images/cuisine/ratatouille.jpg","Lange Veerstraat 4,
2011 DB Haarlem",40,4,1.5,array("Dutch","European","Fish and Seafood"),array("18:00-19:30","19:30-21:00","21:00-22:30"));
    $card->render();
}

//
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
            <img src="../assets/images/cuisine/cookbookImg.png" class = "cookbook--image">
        </section>
    </section>
    <img src="../assets/images/cuisine/shareandwin.png" class = "shareandwin">
</section>


<?php 
    $footer = new footer();
    $footer->renderFooter();
?>
