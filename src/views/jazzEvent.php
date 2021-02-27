<?php
    include '../classes/autoloader.php';

    $contoller = new jazzEventController();

    $head = new head("Jazz Event", "");
    $head->render();

    $navigation = new navigation("Events");
    $navigation->render();
?>

<section class="container section">
<h1 class="header">Upcoming Jazz Events</h1>

<article class='card--jazz'>
    <img src='http://qnimate.com/wp-content/uploads/2014/03/images2.jpg' class='card-jazz_img'>
    <section class='card-jazz_rightcontainer'>
        <p class='card--jazz__artist'>Gumbo Kings</p>
        <p class='card--jazz__time'>17:00 - 18:00</p>
        <p class='card--jazz__loc'><img src="../assets/images/svg/icons/location-icon.svg" style="margin-right:15px; opacity:0.5;">Main Patronaat</p>
        <a href='$this->url' class='card--events__arrow'>
        <img src='arrow image link' alt='' srcset=''></a>
    </section>
</article>

</section>

<?php 
    $footer = new footer();
    $footer->renderFooter();
?>
