<?php
include '../classes/autoloader.php';

$head = new head("Jazz Events | Haarlem Festival", "");
$head->render();
$navigation = new navigation("Events");
$navigation->render();

echo "<section class='container section' style='margin-top: -10px'>";
$jazzIntro = new jazzIntro();
$jazzIntro->render();

$jazzArtistService = new jazzArtistService();
$allJazzArtists = $jazzArtistService->getAllJazzArtists();

$artistNames = array();
$performanceDates = array();

$jazzCards = array();
foreach ($allJazzArtists as $jazzArtist) {
    $artistNames[] = $jazzArtist->__get('artistName');

    foreach ($jazzArtist->__get('performances') as $performance) {
        $performanceDates[] = $performance->getDate();

        if (isset($_GET['artist'])) {
            $artistName = $_GET['artist'];
            if ($jazzArtist->__get('artistName') == $artistName) {
                $jazzCard = new jazzPerformanceCard($performance, $jazzArtist->__get('artistName'), $jazzArtist->__get('thumbnail'));
                $jazzCards[] = $jazzCard;
            }
        }
        else
        {
            $jazzCard = new jazzPerformanceCard($performance, $jazzArtist->__get('artistName'), $jazzArtist->__get('thumbnail'));
            $jazzCards[] = $jazzCard;}
    }}

$uniqueArtistNames = array_unique($artistNames);
$uniquePerformanceDates = array_unique($performanceDates);
sort($uniquePerformanceDates, SORT_STRING);
sort($uniqueArtistNames, SORT_STRING);

$cmb = new jazzComboBox($uniqueArtistNames, $uniquePerformanceDates);
$cmb->render();

$arrayOfCards = array();
foreach ($jazzCards as $card) {
    $arrayOfCards[$card->getDayOfMonth()][] = $card;
}
ksort($arrayOfCards);

$performanceCount = loopCards("count", $arrayOfCards);
echo "<p style='font-size: 14px'> There are $performanceCount event(s) listed.</p>";
loopCards("card", $arrayOfCards);

echo "</section>";
$swoosh = new jazzSwoosh();
$swoosh->render();
$footer = new footer();
$footer->renderFooter();

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