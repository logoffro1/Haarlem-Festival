<?php
@include '../assets/componenets/danceEvent/__danceArtistInfo.scss';
@include '../assets/componenets/danceEvent/__danceEventComps.scss';
@include '../assets/componenets/danceEvent/__danceArtistPerformances.scss';
@include '../assets/componenets/danceEvent/__danceArtistSongs.scss';
@include '../assets/componenets/danceEvent/__danceCombobox.scss';
@include '../assets/componenets/danceEvent/__danceExploreHaarlem.scss';
@include '../assets/componenets/danceEvent/__danceSwoosh.scss';
class danceSwoosh
{
    public function render()
    {
        echo "
        <section class='dance--swoosh' style='padding-top:0px;'>
        <img src='../assets/images/dance/dance-swoosh.png' class='dance--swoosh__img' style='margin-left:1193px; margin-top:60px;'>
        </section>
        ";
    }
}

?>