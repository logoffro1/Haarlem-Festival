<?php

class jazzArtistPerformances
{
    private array $performances;
    public function __construct(array $performances)
    {
        $this->performances = $performances;
    }

    function render()
    {
        echo "
        <section class='container section' id='performances'>
            <section class='performances--jazz'>
                <section class='performances--jazz__row'>
                    <section class='performances--jazz__column'>
                        <h4>When</h4>
                    </section>
                    <section class='performances--jazz__column'>
                        <h4>Where</h4>
                    </section>
                    <section class='performances--jazz__column'>
                        <h4>Price</h4>
                    </section>
                    <section class='performances--jazz__column'>
                    </section>
                </section>";

        foreach($this->performances as $performance)
        {
            $day = $performance -> getDayOfWeek();
            $date = $performance -> getDate(); 
            $time = $performance -> getTime();
            $location = $performance->getLocation();
            $price = number_format($performance->getPrice(), 2);

            
            echo "<section class='performances--jazz__row'>
                        <section class='performances--jazz__column'>
                            <h2 class='performances--jazz__dash'>-</h2>
                            <h2 class='performances--jazz__whenText'>$day, $date | $time</h2>
                        </section>
                        <section class='performances--jazz__column'>
                            <h2>$location</h2>
                        </section>
                        <section class='performances--jazz__column'>
                            <h2>€ $price</h2>
                        </section>
                        <section class='performances--jazz__button'>
                            <a href src='#'><button>Get Your Tickets</button></a>
                        </section>
                    </section>";
        }
        
        echo "
            </section>
            </section>";
    }
}

?>