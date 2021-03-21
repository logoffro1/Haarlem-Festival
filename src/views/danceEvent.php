<?php
include '../classes/autoloader.php';
include '../components/dance/dancePerformanceCard.php';
include '../components/dance/danceSwoosh.php';

$head = new head("Dance Events | Haarlem Festival", "");
$head->render();
$navigation = new navigation("Events");
$navigation->render();

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
	$performance = $danceArtist->__get('performances') ;
        if (isset($_GET['artist']))
        {
            $artistName = $_GET['artist'];
            if ($danceArtist->__get('artistName') == $artistName)
            {
				$danceCards[] = new dancePerformanceCard($danceArtist->__get('artistName'), $danceArtist->__get('thumbnail'), $danceArtist->__get('id'), $danceArtist->__get('performances'));
			}
            else if($artistName == "allArtists")
            {
			$danceCards[] = new dancePerformanceCard($danceArtist->__get('artistName'), $danceArtist->__get('thumbnail'), $danceArtist->__get('id'),$danceArtist->__get('performances'));
            }
        }
        else
        {
            $danceCards[] = new dancePerformanceCard($danceArtist->__get('artistName'), $danceArtist->__get('thumbnail'), $danceArtist->__get('id'), $danceArtist->__get('performances'));
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