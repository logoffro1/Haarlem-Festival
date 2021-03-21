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
        <section class='container section'>
            <h2>You may also be interseted in...</h2>
            <a href='#'>
            <img src='../assets/images/dance/youmaybeinterestedin.png' style='padding: -140px;'></a>
        </section>";
    }
}



?>