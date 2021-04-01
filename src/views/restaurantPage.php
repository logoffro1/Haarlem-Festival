<?php
    include '../classes/autoloader.php';
    $restaurantController = new restaurantController();
    $head = new head("Cuisine Event", "");
    $head->render();

    $navigation = new navigation("");
    $navigation->render();
    if(isset($_GET['id'])){
$restaurant = $restaurantController->getRestaurantById(intval($_GET['id']));
$restaurantName = $restaurant->__get('name');
$restaurantAddress = $restaurant->__get('address');
$restaurantSeats = $restaurant->__get('seats');
$restaurantBiography = $restaurant->__get('biography');
$restaurantStars = $restaurant->__get('stars');
$restaurantSessions = $restaurant->getSessions();
$restaurantImages = $restaurant->__get('images');
echo "
<section class='container section' style='margin-top:-30px;'>
    <pre style='letter-spacing:1px'><a href = 'cuisineEvent.php'>Haarlem Cuisine </a> > <a href = '#'> $restaurantName</a> </pre>
    <section class = ' restaurant restaurant--leftContainer'>
    <article class = 'restaurant title'>
    <h1 class='title title--page cuisine'> $restaurantName </h1>
    <fieldset class = 'restaurant stars'>
 ";
 //print the stars
 for($x = 0; $x < 5; $x++){
    if($x<$restaurantStars){
        echo "<img src='../assets/images/cuisine/starFilled.png'>";
        continue;
    }
    echo "<img src='../assets/images/cuisine/starEmpty.png'>";
}
 echo "
</fieldset>
</article>
<h1 style = 'margin-top:30px'>"; 
//print the cuisines (except All)
$lastIndex = array_key_last($restaurant->__get('cuisines'));
        $i = 0;
        foreach($restaurant->__get('cuisines') as $cuisine){
            if($cuisine->__get('name') == "All") continue;
            echo $cuisine->__get('name'); 
            if($i++ != $lastIndex-1)
                 echo " &#8226 ";
        }
echo "</h1>
<fieldset class = 'restaurant--address restaurant--text'>
<img src='../assets/images/cuisine/homeIcon.svg'>
<h1> $restaurantAddress</h1>
</fieldset>
<fieldset class = 'restaurant--seats restaurant--text'>
<img src='../assets/images/svg/icons/people-24px.svg'>
<h1>$restaurantSeats seats</h1>
</fieldset>
<a href='#reservation'><button class = 'restaurant--text'>Book now</button></a>

<article class = 'restaurant--description restaurant--text'>
<hr>
<p>$restaurantBiography</p>
<hr>
</article>
<article class = 'restaurant reservation'> 
<h1 id = 'reservation'>Make a Reservation</h1>
<hr>
<form action='' method = 'POST'>
    <label for='name'>Fullname</label>
<input placeholder = 'Fullname' type='text' id = 'name' name = 'name'>
<label for='date'>Date</label>
<select name='date' id='date' >

<option value='26'>26-07-2021</option>
<option value='27'>27-07-2021</option>
<option value='28'>28-07-2021</option>
<option value='29'>29-07-2021</option>

</select>
<label for='interval'>Interval</label>
<select name='interval' id='interval'>";
foreach($restaurantSessions as $session){
    echo "<option value='$session'>$session</option>";
}
echo "
</select>
<label for='seats'>Seats</label>
<select name='seats' id='seats'>
<option value='2'>2 seats</option>
<option value='4'>4 seats</option>
<option value='6'>6 seats</option>
<option value='8'>8 seats</option>
<option value='10'>10 seats</option>

</select>
<article class = 'textarea'>
<label for='additiona'>Additional Information</label>
<textarea placeholder = 'Special requests, allergies, etc...' name='additional' id='additional' cols='35' rows='7'></textarea>
</article>
<fieldset class = 'buttons'>
<button>Add to your programme</button>
<button type ='submit' name = 'submit'>Book now</button>
</fieldset>


</form>
<pre class = 'reservation disclaimer'>*A reservation fee of &#8364;10 per person will be
charged when a reservation is made on the
Haarlem Festival site. This fee wil be
deducted from the final check on visiting 
the restaurant.
</pre>
</article>
</section>
";
$count = 1;
//display the images
foreach($restaurantImages as $image){
    echo "<img class = 'images' id = 'img$count' src = '$image'>";
    $count++;
}
echo "
</section>
";
    }
    $footer = new footer();
    $footer->renderFooter();
?>