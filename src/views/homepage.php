<?php
include '../classes/autoloader.php';

$head = new head("homepage", "homepage");
$head->render();

$pageController = new pageController();
$page = $pageController->getPage(5);
?>

<?php 
$navigation = new navigation("Home");
$navigation->render();
?>

<?php 
    $hero = new hero(
        "hero--large container", 
        $page->page_title, 
        $page->page_text, 
        UPLOAD_FOLDER.$page->page_image,
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
        <img class="col-5 col-offset-1" src="<?php echo UPLOAD_FOLDER . $page->first_section_image; ?>" alt="">
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

<?php
    $countdown = new countdown("Ticket sales and in:", "#");
    $countdown->render();


    $footer = new footer();
    $footer->renderFooter();
?>