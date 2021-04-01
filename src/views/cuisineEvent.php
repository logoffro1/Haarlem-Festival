<?php
    include '../classes/autoloader.php';
    include ('../model/pdfInvoice.php');
    //init controllers
    $contoller = new cuisineEventController();
    $restaurantTypeController = new restaurantTypeController();
    $restaurantController = new restaurantController();
    $restaurants = $restaurantController->getRestaurants();
    $head = new head("Cuisine Event", "");
    $head->render();

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
    <article class="vLine"></article>
    
    <article class="row">
    
        <?php
        //loop through all the restaurants and display them as needed
function loopRestaurants(array $restaurants){
    $count = 0;
  
    foreach($restaurants as $r){
        if(isset($_GET['filter'])){
            if($r->hasCuisine($_GET['filter'])){
                $card = new restaurantCard($r->__get('id'),
                $r->__get('name'),
                "..".$r->__get('images')[0],
                $r->__get('address'),
                $r->__get('seats'),
                $r->__get('stars'),
                $r->__get('duration'),
                $r->__get('cuisines'),
                $r->getSessions());
                $card->render();
                $count++;
            }
        } else{
           
            $card = new restaurantCard($r->__get('id'),
                $r->__get('name'),
                "..".$r->__get('images')[0],
                $r->__get('address'),
                $r->__get('seats'),
                $r->__get('stars'),
                $r->__get('duration'),
                $r->__get('cuisines'),
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
<h2 style="position:absolute;margin-left:190px;margin-top:30px"> Results shown: <?php echo $restaurantCount;?> </h2>
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
            <a href = "pdfCookbook.php" target = "_blank">
            <button>Download the cookbook</button>
</a>
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