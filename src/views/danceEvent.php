<?php
include '../classes/autoloader.php';
include '../components/cart/cartSession.php';

$head = new head("Dance Events | Haarlem Festival", "");
$head->render();
$navigation = new navigation("Events");
$navigation->render();

$pageController = new pageController();
$page = $pageController->getPage(2);

$pageHero = new hero("hero--medium hero--overlay dance container", $page->page_title, "", $page->page_image);
$artistPrimotionHero = new hero("hero--small hero--overlay dance container", $page->hero_title, "", $page->hero_image);

$pageHero->render(); // ../assets/images/dance/header.png
?>



<section class='container section'>
    <article class='row align-items-left'>
        <header class='col-5'>
            <section class='hero text-top-left'>
                <span>
                    <h1 class='title title--page dance'>
                        <?php
                            echo $page->first_section_title; 
                        ?>
                    </h1>
                    <a class='button' href='#artists'>Check out the artists</a>
                </span>
            </section>
        </header>
        <header class='col-5' style='border-color: white; border-top-right-radius: 50%;'>
            <section class='hero text-top-left' style='position:relative;'>
                <p>
                    <?php
                        echo $page->first_section_text; 
                    ?>
                </p>
            </section>
        </header>
    </article>
</section>

<?php
    $artistPrimotionHero->render(); // ../assets/images/dance/Below_header_2.jpg
?>


<section class='container section'>
    <article class='row align-items-left'>
        <header class='col-5'>
            <section class='hero text-top-left'>
                <span>
                    <h1 class='title title--page dance'>
                        <?php
                            echo $page->second_section_title; 
                        ?>
                    </h1>
                    <a class='button' href='/views/bookmoresavemore.php'>Find out more</a>
                </span>
            </section>
        </header>
        <header class='col-5' style='border-color: white; border-top-right-radius: 50%;'>
            <section class='hero text-top-left' style='position:relative;'>
                <p>
                    <?php
                        echo $page->second_section_text; 
                    ?>
                </p>
            </section>
        </header>
    </article>
</section>

<?php
$artistController = new artistController();
$allDanceArtists = $artistController->getAllDataDanceArtistList();

$artistNames = array();
$performanceDates = array();

$danceCards = array();
foreach ($allDanceArtists as $danceArtist) {
    $artistNames[] = $danceArtist->__get('name');
	$performance = $danceArtist->__get('performances');
    
    if (isset($_GET['artist']))
    {
        $artistName = $_GET['artist'];
        if ($danceArtist->__get('name') == $artistName)
        {
            $danceCards[] = new dancePerformanceCard($danceArtist->__get('name'), $danceArtist->__get('thumbnail'), $danceArtist->__get('id'), $danceArtist->__get('performances'));
        }
        else if($artistName == "allArtists")
        {
        $danceCards[] = new dancePerformanceCard($danceArtist->__get('name'), $danceArtist->__get('thumbnail'), $danceArtist->__get('id'),$danceArtist->__get('performances'));
        }
    }
    else
    {
        $danceCards[] = new dancePerformanceCard($danceArtist->__get('name'), $danceArtist->__get('thumbnail'), $danceArtist->__get('id'), $danceArtist->__get('performances'));
    }
}

$uniqueArtistNames = array_unique($artistNames);
$uniquePerformanceDates = array_unique($performanceDates);
sort($uniquePerformanceDates, SORT_STRING);
sort($uniqueArtistNames, SORT_STRING);

$arrayOfCards = array();
foreach ($danceCards as $card) {
    $arrayOfCards[$card->getDayOfMonth()][] = $card;
}
ksort($arrayOfCards);

$performanceCount = loopCards("count", $arrayOfCards);
loopCards("card", $arrayOfCards);

function loopCards(string $input, array $arrayOfCards)
{
    $performanceCount = 0;
    foreach ($arrayOfCards as $date => $cards) {
        foreach ($cards as $card) {
            if ($input == "card") {
                $card->render();
            } else if ($input == "count") {
                $performanceCount++;
            }
        }
    }
    return $performanceCount;
}
?>

<?php
    $_SESSION['cart']->render();
    $footer = new footer();
    $footer->renderFooter();
?>