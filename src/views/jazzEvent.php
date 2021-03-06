<?php
include '../classes/autoloader.php';
include '../components/cart/cartSession.php';


$head = new head("Jazz Events | Haarlem Festival", "");
$head->render();
$navigation = new navigation("Events");
$navigation->render();

$pageController = new pageController();
$page = $pageController->getPage(4);

//Getting cart info rendered
$_SESSION['cart']->render();

?>

<section class='section no-padding-bottom'>
    <h1 class='title title--page jazz container'><?php echo $page->page_title; ?></h1>
    <img class='hero is-full-width' src='<?php echo $page->image; ?>'>
</section>

<section class='container section no-padding-top' style='margin-top: -10px'>
<?php

//Getting every artist to list their performances
$artistController = new artistController();
$allJazzArtists = $artistController->getAllDataJazzArtistList();

$artistNames = array();
$performanceDates = array();

$jazzCards = array();
//Looping through each artist to get info to fill jazz performance cards and combobox
foreach ($allJazzArtists as $jazzArtist) 
{
    //Those names are for combobox
    $artistNames[] = $jazzArtist->__get('name');

    if(isset($jazzArtist->performances) && count($jazzArtist->performances) == 0){
        return;
    }
    
    foreach ($jazzArtist->performances as $performance) 
    {
        //Those dates are for combobox
        $performanceDates[] = $performance->getDate();

        if (isset($_GET['artist']) || isset($_GET['date'])) 
        {
            $artistName = $_GET['artist'];
            $performanceDate = $_GET['date'];
            
            //Print all
            if($performanceDate == "allDates" && $artistName == "allArtists")
                $jazzCards[] = new jazzPerformanceCard($performance, $jazzArtist->__get('name'), $jazzArtist->__get('thumbnail'), $jazzArtist->__get('id'));
            //Filter artist name
            else if($performanceDate== "allDates" && $jazzArtist->__get('name') == $artistName )
                $jazzCards[] = new jazzPerformanceCard($performance, $jazzArtist->__get('name'), $jazzArtist->__get('thumbnail'), $jazzArtist->__get('id'));
            //Filter date
            else if($artistName == "allArtists" && $performance->getDate() == $performanceDate)
                $jazzCards[] = new jazzPerformanceCard($performance, $jazzArtist->__get('name'), $jazzArtist->__get('thumbnail'), $jazzArtist->__get('id'));
            //Filter both date and artist name
            else if($performance->getDate() == $performanceDate &&  $jazzArtist->__get('name') == $artistName)
                $jazzCards[] = new jazzPerformanceCard($performance, $jazzArtist->__get('name'), $jazzArtist->__get('thumbnail'), $jazzArtist->__get('id'));
            }
        //If no parameter print all
        else
        $jazzCards[] = new jazzPerformanceCard($performance, $jazzArtist->__get('name'), $jazzArtist->__get('thumbnail'), $jazzArtist->__get('id'));
    }
}

//After getting names and dates, getting unique values then sorting them
$uniqueArtistNames = array_unique($artistNames);
$uniquePerformanceDates = array_unique($performanceDates);
sort($uniquePerformanceDates, SORT_STRING);
sort($uniqueArtistNames, SORT_STRING);

//Creating combobox based on unique name and date values
$cmb = new jazzComboBox($uniqueArtistNames, $uniquePerformanceDates);
$cmb->render();

//Sorting performance cards according to their date
$arrayOfCards = array();
foreach ($jazzCards as $card) {
    $arrayOfCards[$card->getDayOfMonth()][] = $card;
}
ksort($arrayOfCards);

//Creating the p tag so that it can be filled later with javascript
echo "<p id ='performanceCountInfo' style='font-size: 14px'></p>";

//Rendering each card and editing p tag with javascript
$performanceCount = loopCards($arrayOfCards);
echo sprintf("<script>document.getElementById('performanceCountInfo').innerHTML = 'There are %s event(s) listed.';</script></section>", $performanceCount);

$swoosh = new swoosh('jazz');
$swoosh->render();
$footer = new footer(); 
$footer->renderFooter();

function loopCards(array $arrayOfCards)
{
    $performanceCount = 0;
    foreach ($arrayOfCards as $date => $cards) 
    {
        foreach ($cards as $card) 
        {
            $card->render();
            $performanceCount++;
        }
    }
    return $performanceCount;
}

?>