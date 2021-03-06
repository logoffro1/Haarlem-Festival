<?php
    include '../classes/autoloader.php';

    $contoller = new jazzArtistController();

    $head = new head("Artist Name", "");
    $head->render();

    $navigation = new navigation("Events");
    $navigation->render();

?>

<section style="display:inline-flex; height: 713px; width: 100%;">
    <section style="display:inline-flex;
                                height: 100%; 
                                width:45%;">
        <img src="../assets/images/jazz/artists/gare-du-nord.png" alt="" >
    </section>
    <section style="height: 100%; 
                                width: 55%; 
                                ">
        <p style="margin-bottom: 60px; margin-left: 150px;">Jazz Artists > Gare Du Nord</p>
        <section style="width: 60%; 
                                    height:70%; 
                                    padding-top: 80px;
                                    padding-left: 80px;
                                    background-color:white;
                                    transform: rotate(5deg);">
        
            <section style="transform: rotate(-5deg); width:76%;">
                <h1 class='title title--page jazz'> Gare du Nord </h1>
                <p>
                    Gare du Nord is a Dutch-Belgian jazz band, originally consisting of Doc (Ferdi Lancee) and Inca (Barend Fransen). 
                    Doc played guitar and Inca played saxophone, while both performed vocal duties. After the pair split in 2013, 
                    the band continues working and touring with a different lineup. 
                </p>
                <section style="margin-top: 120px;">
                <a href="#"><img src="../assets/images/jazz/icons/jazz-instagram.png" alt="" style="margin-right:30px"></a>
                <a href="#"><img src="../assets/images/jazz/icons/jazz-facebook.png" alt="" style="margin-right:30px"></a>
                <a href="#"><img src="../assets/images/jazz/icons/jazz-youtube.png" alt="" style="margin-right:30px"></a>

                <a href="#"><button style="float: right;">Get Your Tickets</button></a>
            </section>
            </section>
        </section>
        <img>
        </section>
    </section>
</section>
<section class='container section'>




</section>

<?php 
    $swoosh = new jazzSwoosh();
    $swoosh->render();
    $footer = new footer();
    $footer->renderFooter();
?>