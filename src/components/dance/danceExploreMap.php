<?php
@include '../assets/componenets/danceEvent/__danceArtistInfo.scss';
@include '../assets/componenets/danceEvent/__danceEventComps.scss';
@include '../assets/componenets/danceEvent/__danceArtistPerformances.scss';
@include '../assets/componenets/danceEvent/__danceArtistSongs.scss';
@include '../assets/componenets/danceEvent/__danceCombobox.scss';
@include '../assets/componenets/danceEvent/__danceExploreHaarlem.scss';
@include '../assets/componenets/danceEvent/__danceSwoosh.scss';
class danceExploreMap
{
    function render()
    {
        echo "
        <section class='container section exploreHaarlem--dance'>
            <h2 style='margin-right:250px;'>Arrive Early, Enjoy More!</h2>
            <img src='../assets/images/dance/exploreHaarlem/map.jpg'>
        </section>
        ";
    }
}
?>