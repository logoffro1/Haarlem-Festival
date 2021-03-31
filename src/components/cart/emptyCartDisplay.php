<?php
include __DIR__.'/../../classes/autoloader.php';

class emptyCartDisplay
{
    public function render()
    {
        echo "
                    <section class='container section page--emptyCart'>
                        <h1 class='page--emptyCart__title'>Your cart is empty.</h1>
                        <section class='row col-8 col-offset-1 page--emptyCart__cardContainer'>";

                    $cuisineEvent = new eventCards("cuisine", "get inspired by", "The haarlem cuisine", "#");
                    $historyEvent = new eventCards("history", "Discover", "The haarlem history", "#");
                    $danceEvent = new eventCards("dance", "Get wild during", "The haarlem dance", "#");
                    $jazzEvent = new eventCards("jazz", "Check out", "The haarlem jazz", "#");
    
                    $cuisineEvent->render();
                    $historyEvent->render();
                    $danceEvent->render();
                    $jazzEvent->render();

        echo "</section></section>";
    }
}
?>