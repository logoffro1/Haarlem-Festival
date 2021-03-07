<?php

include '../classes/autoloader.php';

$contoller = new jazzPerformanceController();
$performances = $contoller -> getAllJazzPerformances();
$performanceCount = count($performances);

$head = new head("Jazz Events | Haarlem Festival", "");
$head->render();
$navigation = new navigation("Events");
$navigation->render();

echo "<section class='container section' style='margin-top: -10px'>";
$jazzIntro = new jazzIntro();
$jazzIntro->render();

$artists = array();
$dates = array();

foreach($performances as $performance)
{
    $artists[] = $performance->getArtistName();
    $dates[] = $performance->getDate();
}
$artists_unique = array_unique($artists);
$dates_unique = array_unique($dates);

$cmb = new jazzComboBox($artists_unique, $dates_unique);
$cmb->render();

echo "<p style='font-size: 14px'> There are $performanceCount event(s) listed.</p>";

foreach($performances as $performance)
{
$card_test = new jazzPerformanceCard($performance);
$card_test->render();
}
echo "</section>";

$swoosh = new jazzSwoosh();
$swoosh->render();
$footer = new footer();
$footer->renderFooter();
?>
