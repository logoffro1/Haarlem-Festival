<?php
    include '../classes/autoloader.php';

    //init controllers
    $head = new head("Cuisine Event", "");
    $head->render();

    $contoller = new cuisineEventController();
    $restaurantTypeController = new restaurantTypeController();
    $restaurantController = new restaurantController();
    $restaurants = $restaurantController->getRestaurants();

    $navigation = new navigation("");
    $navigation->render();

    /*
    $cartCuisine = new cartItem("Cuisine Event",3,"This is an address","Thursday","27 July","17:00",2,13.20,"I am allergic to shellfish");
    $cartjazz = new cartItem("Jazz Event",0,"This is another address","Friday","28 July","18:00",1,10.00,"");
    $cart = new cart();
    $cart->setCartItems(array($cartCuisine,$cartjazz));
    $mail = new pdfInvoice($cart,"k3nnt_u_99@yahoo.com");
*/


    //if there is no filter, filter defaults to All
    if(!isset($_GET['filter']))
        $_GET['filter'] = "All";

    //when the "filter' button is pressed
    if(isset($_POST['submit'])){
        if(!empty($_POST['cuisines'])){
           $location = getLocation();
            header("Location: $location");
        }      
        
    }
    //create the ?filter URL based on the filter
     function getLocation(){
        $location = '?filter=';
        $count = 0;
        foreach ($_POST['cuisines'] as $selected) {
            if ($count != 0)
                $location .= ";";
            $location .= $selected;
            $count++;
        }
        return $location;
    }





?>
<section class="container section" style="margin-top:-30px;">
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
echo "<form method = 'post'>";


if(isset($_GET['filter']))
    $location = $_GET['filter'];

    //loop through all cuisines and add them as checkbokes
foreach($cuisines as $cuisine){

    //if the filter contains a checkbox, make the checkbok selected
    if((strpos($location,$cuisine->__get('name'))!== FALSE))
    {
        $checkbox = new checkbox($cuisine->__get('name'),"cuisines[]",$cuisine->__get('name'),$cuisine->__get('name'),true);
    }
    else
        $checkbox = new checkbox($cuisine->__get('name'),"cuisines[]",$cuisine->__get('name'),$cuisine->__get('name'));

    $checkbox->render();
}
echo "<button type = 'submit' name = 'submit'>Filter</button>";
echo "</form></fieldset>";
?>
    <hr class="hLine">

    <article class="row justify-content-between restaurant-card-wrapper">

        <?php
        //loop through all the restaurants and display them as needed
function loopRestaurants(array $restaurants){
    $count = 0;
    
    foreach($restaurants as $r){
        if(isset($_GET['filter'])){
            if($r->hasCuisine($_GET['filter']) || $_GET['filter'] == 'All'){
                $card = new restaurantCard($r->id,
                $r->name,
                "..".$r->images[0],
                $r->address,
                $r->seats,
                $r->stars,
                $r->duration,
                $r->cuisines,
                $r->getSessions());
                $card->render();
                $count++;
            }
        } else {
            $card = new restaurantCard($r->id,
                $r->name,
                "..".$r->images[0],
                $r->address,
                $r->seats,
                $r->stars,
                $r->duration,
                $r->cuisines,
                $r->getSessions());      
                $card->render();
                $count++;
        }
       
        
    }
    return $count;
}
//store how many restaurants are displayed
$restaurantCount = loopRestaurants($restaurants);

?>
<h2 style="position:absolute;margin-top:30px"> Results shown: <?php echo $restaurantCount;?></h2>
</article>

</section>
<section class="cookbook-outer-area">
    <section class="container row align-items-end">
        <article class="col-5">
            <h1 class="title title--page cuisine">Cook like a Chef</h1>
            <p class="cookbook--description">
                Want to become a chef yourself, or are you ready for
                something new? Try out our new cookbook!
                Checkout a wide array of diverse recipes, made by the chefs
                of the Haarlem Festival.
            </p>
            <a href="pdfCookbook.php" class="button button--secondary" target="_blank">Download the cookbook</a>
        </article>
        <article class="rightContainer col-4">
            <h2>Cooking Styles</h2>
            <ul class="row">
                <li class="col-6"><span class = "bullet">&#8226</span> French</li>
                <li class="col-6"><span class = "bullet">&#8226</span> Fish and Seafood</li>
                <li class="col-6"><span class = "bullet">&#8226</span> Vegan</li>
                <li class="col-6"><span class = "bullet">&#8226</span> Favorites of the Chefs</li>
                <li class="col-6"><span class = "bullet">&#8226</span> European</li>
                <li class="col-6"><span class = "bullet">&#8226</span> Modern</li>
                <li class="col-6"><span style = "font-weight:600;">And many more!</span></li>
            </ul>
        </article>
        <img src="../assets/images/cuisine/cookbookImg.png" class="col-3 cookbook--image">
    </section>
    <!-- <img src="../assets/images/cuisine/shareandwin.png" class="shareandwin"> -->
</section>
<section class="container cuisine-promo section">
    <article class="text-align--center col-6 col-offset-3">
        <h3 class="title title--page cuisine">
            Share and Win
        </h3>
        <p class="">
            Want to win back your spendings of your restaurant bill?
            Make a photo of your food and/or dinner experience
            and win back your spendings!
        </p>

        <ul class="cuisine-promo__steps row">
            <li class="col-4">
                <img src="/assets/images/svg/icons/add_a_photo-24px.svg" alt="">
                <span>Take a picture during your restaurant visit or your cooked recipe from the cookbook</span>
            </li>
            <li class="col-4">
                <img src="/assets/images/svg/icons/cloud-upload.svg" alt="">
                <span>Upload your picture to Instagram, or Facebook with #HaarlemFestivalCashback</span>
            </li>
            <li class="col-4">
                <img src="/assets/images/svg/icons/euro.svg" alt="">
                <span>Have a chance to win-back
                your dinner spendings</span>
            </li>
        </ul>
    </article>
</section>

<?php 
    $footer = new footer();
    $footer->renderFooter();
?>