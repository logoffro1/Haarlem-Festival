<?php
    include '../classes/autoloader.php';

    $contoller = new jazzArtistController();

    $head = new head("Gare du Nord | Haarlem Festival", "");
    $head->render();

    $navigation = new navigation("Events");
    $navigation->render();

    $jazzIntro = new jazzArtistInfo();
    $jazzIntro->render();

?>

<section class='container section'>
    <h1>Explore The Music</h2>
    <section class='artistSongs--jazz'>

        <section class='artistSongs--jazz__cardSection'>
        <img class='artistSongs--jazz__songPic' src='../assets/images/jazz/songs/gare-du-nord-sex-n-jazz.png' alt=''>
        <img class='artistSongs--jazz__playIcon'  src='../assets/images/jazz/icons/songs-play-button.png'>
        <p>Gare du Nord - Sex'n'Jazz</p>
        </section>

        <section class='artistSongs--jazz__cardSection'>
        <img class='artistSongs--jazz__songPic' src='../assets/images/jazz/songs/gare-du-nord-sex-n-jazz.png' alt=''>
        <img class='artistSongs--jazz__playIcon'  src='../assets/images/jazz/icons/songs-play-button.png'>
        <p>Gare du Nord - Sex'n'Jazz</p>        
        </section>

        <section class='artistSongs--jazz__cardSection'>
        <img class='artistSongs--jazz__songPic' src='../assets/images/jazz/songs/gare-du-nord-sex-n-jazz.png' alt=''>
        <img class='artistSongs--jazz__playIcon'  src='../assets/images/jazz/icons/songs-play-button.png'>
        <p>Gare du Nord - Sex'n'Jazz</p>
        </section>

        <section class='artistSongs--jazz__cardSection'>
        <img class='artistSongs--jazz__songPic' src='../assets/images/jazz/songs/gare-du-nord-sex-n-jazz.png' alt=''>
        <img class='artistSongs--jazz__playIcon'  src='../assets/images/jazz/icons/songs-play-button.png'>
        <p>Gare du Nord - Sex'n'Jazz</p>
        </section>

      

    </section>
</section> 


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<?php 
    $swoosh = new jazzSwoosh();
    $swoosh->render();
    $footer = new footer();
    $footer->renderFooter();
?>