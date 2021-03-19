<?php

class jazzArtistPerformances
{



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
                </section>

        <section class='performances--jazz__row'>
            <section class='performances--jazz__column'>
                <h1 class='performances--jazz__dash'>-</h1>
                <h2 class='performances--jazz__whenText'>Saturday, 28 July | 18:00 - 19:00</h2>
            </section>
            <section class='performances--jazz__column'>
                <h2>Mail Hall, Patronaat</h2>
            </section>
            <section class='performances--jazz__column'>
                <h2>€ 15,00</h2>
            </section>
            <section class='performances--jazz__column'>
                <a href src='#'><button>Get Your Tickets</button></a>
            </section>
        </section>

        <section class='performances--jazz__row'>
            <section class='performances--jazz__column'>
                <h1 class='performances--jazz__dash'>-</h1>
                <h2 class='performances--jazz__whenText'>Sunday, 29 July | 20:00 - 21:00</h2>
            </section>
            <section class='performances--jazz__column'>
                <h2>Grote Markt</h2>
            </section>
            <section class='performances--jazz__column'>
                <h2>FREE</h2>
            </section>
            <section class='performances--jazz__column'>
                <a href src='#'><button>Get Your Tickets</button></a>
            </section>
        </section>
        <hr style='margin: 100px auto; color: #f5f5f5; width: 1000px;'>
    </section>
</section>";
    }
}

?>