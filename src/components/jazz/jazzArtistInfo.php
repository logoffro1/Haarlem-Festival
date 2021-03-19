<?php

class jazzArtistInfo
{


public function render()
{
    echo "<section class='artistinfo--jazz'>
    <section class='artistinfo--jazz__artistImg'>
        <img src='../assets/images/jazz/artists/gare-du-nord.png' alt='' >
    </section>
    <section>
        <p class='artistinfo--jazz__breadCrumb'>Jazz Artists > Gare Du Nord</p>
        <section class='artistinfo--jazz__textContainer'>
            <section class='artistinfo--jazz__infoText'>
                <h1 class='title title--page jazz'> Gare du Nord </h1>
                <p>
                    Gare du Nord is a Dutch-Belgian jazz band, originally consisting of Doc (Ferdi Lancee) and Inca (Barend Fransen). 
                    Doc played guitar and Inca played saxophone, while both performed vocal duties. After the pair split in 2013, 
                    the band continues working and touring with a different lineup. 
                </p>
                <section class='artistinfo--jazz__socialMediaContainer'>
                <a href='#'><img src='../assets/images/jazz/icons/jazz-instagram.png' alt='' class='artistinfo--jazz__socialMediaIcons'></a>
                <a href='#'><img src='../assets/images/jazz/icons/jazz-facebook.png' alt='' class='artistinfo--jazz__socialMediaIcons'></a>
                <a href='#'><img src='../assets/images/jazz/icons/jazz-youtube.png' alt='' class='artistinfo--jazz__socialMediaIcons'></a>
                <a href='#'><button class='artistinfo--jazz__ticketButton'>Get Your Tickets</button></a>
            </section>
            </section>
        </section>
        </section>
    </section>
</section>";
}

}


?>