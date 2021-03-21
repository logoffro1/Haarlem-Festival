<?php
include '../classes/autoloader.php';

$head = new head("Dance Events | Haarlem Festival", "");
$head->render();
$navigation = new navigation("Events");
$navigation->render();

echo "<section class='container section' style='margin-top: -10px'>";
$danceIntroController = new danceIntroController();
$danceIntro = $danceIntroController->getHeaderInfo();
$danceIntro->render();

$danceArtistController = new danceArtistController();
$allDanceArtists = $danceArtistController->getAllDanceArtists();

$artistNames = array();
$performanceDates = array();

$danceCards = array();
foreach ($allDanceArtists as $danceArtist) {
    $artistNames[] = $danceArtist->__get('artistName');

    foreach ($danceArtist->__get('performances') as $performance)
    {
        $performanceDates[] = $performance->getDate();

        if (isset($_GET['artist']) || isset($_GET['date']))
        {
            $artistName = $_GET['artist'];
            $performanceDate = $_GET['date'];

            if ($danceArtist->__get('artistName') == $artistName)
            {
                if($performance->getDate() == $performanceDate)
                {
                    $danceCards[] = new dancePerformanceCard($performance, $danceArtist->__get('artistName'), $danceArtist->__get('thumbnail'), $danceArtist->__get('id'));
                }
                else if($performanceDate == "allDates")
                {
                    $danceCards[] = new dancePerformanceCard($performance, $danceArtist->__get('artistName'), $danceArtist->__get('thumbnail'), $danceArtist->__get('id'));
                }
            }
            else if($artistName == "allArtists")
            {
                 if($performance->getDate() == $performanceDate)
                {
                    $danceCards[] = new dancePerformanceCard($performance, $danceArtist->__get('artistName'), $danceArtist->__get('thumbnail'), $danceArtist->__get('id'));
                }
                else if($performanceDate == "allDates")
                {
                    $danceCards[] = new dancePerformanceCard($performance, $danceArtist->__get('artistName'), $danceArtist->__get('thumbnail'), $danceArtist->__get('id'));
                }
            }
        }
        else
        {
            $danceCards[] = new dancePerformanceCard($performance, $danceArtist->__get('artistName'), $danceArtist->__get('thumbnail'), $danceArtist->__get('id'));
        }
    }}

$uniqueArtistNames = array_unique($artistNames);
$uniquePerformanceDates = array_unique($performanceDates);
sort($uniquePerformanceDates, SORT_STRING);
sort($uniqueArtistNames, SORT_STRING);

$cmb = new danceComboBox($uniqueArtistNames, $uniquePerformanceDates);
$cmb->render();

$arrayOfCards = array();
foreach ($danceCards as $card) {
    $arrayOfCards[$card->getDayOfMonth()][] = $card;
}
ksort($arrayOfCards);

$performanceCount = loopCards("count", $arrayOfCards);
echo "<p style='font-size: 14px'> There are $performanceCount event(s) listed.</p>";
loopCards("card", $arrayOfCards);

echo "</section>";
$swoosh = new danceSwoosh();
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