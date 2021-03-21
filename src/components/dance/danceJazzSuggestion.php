<?php
@include '../assets/componenets/danceEvent/__danceArtistInfo.scss';
@include '../assets/componenets/danceEvent/__danceEventComps.scss';
@include '../assets/componenets/danceEvent/__danceArtistPerformances.scss';
@include '../assets/componenets/danceEvent/__danceArtistSongs.scss';
@include '../assets/componenets/danceEvent/__danceCombobox.scss';
@include '../assets/componenets/danceEvent/__danceExploreHaarlem.scss';
@include '../assets/componenets/danceEvent/__danceSwoosh.scss';
class danceDanceSuggestion
{
    public function render()
    {
        echo "
        <section class='container-fluid section' style='padding-top:0px;'>
            <h2>You may also be interseted in...</h2>
            <a href='#'>
            <img src='../assets/images/dance/youmaybeinterestedin.png'></a>
        </section>";
    }
}



?>