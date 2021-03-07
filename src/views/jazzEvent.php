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
$performanceCount = 0;

$jazzCards = array();
foreach($allJazzArtists as $jazzArtist)
{
    $artistNames[] = $jazzArtist->__get('artistName');

    foreach($jazzArtist->__get('performances') as $performance)
    {
        $performanceDates[] = $performance->getDate();
        $performanceCount++;

        $jazzCard = new jazzPerformanceCard($performance, $jazzArtist->__get('artistName'), $jazzArtist->__get('thumbnail'));
        $jazzCards[] = $jazzCard;
    }
}

$uniqueArtistNames = array_unique($artistNames);
$uniquePerformanceDates = array_unique($performanceDates);

$cmb = new jazzComboBox($uniqueArtistNames, $uniquePerformanceDates);
$cmb->render();

echo "<p style='font-size: 14px'> There are $performanceCount event(s) listed.</p>";
foreach($jazzCards as $card)
{
    $card->render();
}




echo "</section>";

$swoosh = new jazzSwoosh();
$swoosh->render();
$footer = new footer();
$footer->renderFooter();
?>
