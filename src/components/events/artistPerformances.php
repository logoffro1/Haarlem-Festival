<?php

class artistPerformances
{
    private array $performances;
    private string $performanceType;

    public function __construct(array $performances, string $performanceType)
    {
        $this->performances = $performances;
        $this->performanceType = $performanceType;
    }

    function render()
    {
        echo "
        <section class='container section' id='performances'>
            <section class='performances'>
                <section class='performances__row'>
                    <section class='performances__column performance__table-title'>
                        <h4>When</h4>
                    </section>
                    <section class='performances__column performance__table-title'>
                        <h4>Where</h4>
                    </section>
                    <section class='performances__column performance__table-title'>
                        <h4>Price</h4>
                    </section>
                    <section class='performances__column performance__table-title'>
                    </section>
                </section>";

        foreach($this->performances as $performance)
        {
            $artist = $_GET['artist'];
            $performanceID = $performance->__get('id');
            $day = $performance -> getDayOfWeek();
            $date = $performance -> getDate(); 
            $time = $performance -> getTime();
            $location = $performance->getLocation();
            $price = number_format($performance->getPrice(), 2);

            
            echo "  <form>
                        <section class='performances__row'>
                        <section class='performances__column'>
                        <input type='hidden' name='artist' value=$artist>  
                        <input type='hidden' name='type' value='$this->performanceType'>
                        <input type='hidden' name='performanceID' value=$performanceID>  
                            <span class='performances__dash $this->performanceType'></span>
                            <h2 class='performances__whenText'>$day, $date | $time</h2>
                        </section>
                        <section class='performances__column'>
                            <h2>$location</h2>
                        </section>
                        <section class='performances__column'>
                            <h2>€ $price</h2>
                        </section>
                        <section class='performances__button'>
                            <button>Get Your Tickets</button>
                        </section>
                    </section>
                    </form>";
        }
        
        echo "
            </section> 
            </section>";
    }
}

?>