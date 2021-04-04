<?php
include '../classes/autoloader.php';
include '../components/cart/cartSession.php';

$head = new head("homepage", "homepage");
$head->render();

$pageController = new pageController();
$page = $pageController->getPage(5);
?>

<?php 
$navigation = new navigation("Home");
$navigation->render();

$_SESSION['cart']->render();
?>

<?php 
    $hero = new hero(
        "hero--large container", 
        $page->page_title, 
        $page->page_text, 
        $page->page_image,
        true
    );

    $hero->render();
?>

<section class="container section">
    <article class="row align-items-center">
        <header class="col-5">
            <h1 class="title title--page dance"><?php echo $page->first_section_title; ?></h1>
            <p><?php echo $page->first_section_text; ?></p>
        </header>
        <img class="col-5 col-offset-1" src="<?php echo $page->first_section_image; ?>" alt="">
    </article>
</section>

<section class="container section section--background">
    <article class="row align-items-center">
        <header class="col-5 col-offset-1">
            <h1 class="title title--page history"><?php echo $page->second_section_title; ?></h1>
            <p>
                <?php echo $page->second_section_text; ?>
            </p>
        </header>
        <ul class="col-5 col-offset-1 ul--disc ul--large-margin">

            <?php foreach (explode(";", $page->second_section_list) as $item) {
                echo "<li>$item</li>";
            } ?>
        </ul>
    </article>
</section>

<section class="container section">
    <article class="row align-items-center">
        <header class="col-4">
            <h1 class="title title--page dance"><?php echo $page->third_section_title; ?></h1>
            <p>
                <?php echo $page->third_section_text; ?>
            </p>
        </header>
        <section class="row col-7 col-offset-1">
            <?php
                $cuisineEvent = new eventCards("cuisine", "get inspired by", "The haarlem cuisine", "/views/cuisineEvent.php");
                $historyEvent = new eventCards("history", "Discover", "The haarlem history", "#");
                $danceEvent = new eventCards("dance", "Get wild during", "The haarlem dance", "/views/danceEvent.php");
                $jazzEvent = new eventCards("jazz", "Check out", "The haarlem jazz", "/views/jazzEvent.php");

                $cuisineEvent->render();
                $historyEvent->render();
                $danceEvent->render();
                $jazzEvent->render();
            ?>
        </section>
    </article>
</section>

<?php
    $countdown = new countdown("Ticket sales end in:", "#");
    $countdown->render();


    $footer = new footer();
    $footer->renderFooter();
?>