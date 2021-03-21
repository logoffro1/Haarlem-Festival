<?php
@include '../assets/componenets/danceEvent/__danceArtistInfo.scss';
@include '../assets/componenets/danceEvent/__danceEventComps.scss';
@include '../assets/componenets/danceEvent/__danceArtistPerformances.scss';
@include '../assets/componenets/danceEvent/__danceArtistSongs.scss';
@include '../assets/componenets/danceEvent/__danceCombobox.scss';
@include '../assets/componenets/danceEvent/__danceExploreHaarlem.scss';
@include '../assets/componenets/danceEvent/__danceSwoosh.scss';
class danceExploreHaarlem
{
    public function render()
    {
        echo "
        <section class='container-fluid section' style='padding-top: 0px; padding-left:7%; padding-right:7%;'>
        <article class='row align-items-left'>
            <header class='col-12'>
                <section class='hero text-top-left' style='position:relative;'>
                    <h1 style='margin-top: 60px; margin-left: 0px;'class='title'><b>Explore <u>Haarlem</u> before the event!<br> and meet like-minded people</b></h1>
                </section>
               </header>
           </article>
           <article class='row align-items-left'>
            <header class='col-6'>
                <section class='hero text-top-left' style='position:relative;'>
                    <p>Did you know that in Haarlem there are many dance clubs for dance lovers such as yourself? We have found the closest two for you to check out if you want, meet up with people that have same interests as you!</p>
                </section>
               </header>
           </article>
           <article class='row align-items-left'>
            <header class='col-6'>
                <section class='hero text-top-left' style='position:relative;'>
                    <img src='../assets/images/dance/exploreHaarlem/letz party.png' style='z-index:2;'>
                </section>
               </header>
               <header class='col-6'>
                <section class='hero text-top-left' style='position:relative;'>
                    <p><b>Letz Party</b><br> Letz Party is a club for all, open from 8:30PM - 1:30AM on the Weekends.
                        This is perfect stay for you to relax before or after one of our crazy dance events. <br><b>Address: Gasthuisstraat 36, 2011 XP Haarlem, Netherlands</b> </p>
                </section>
               </header>
           </article>

           <article class='row align-items-left'>
            <header class='col-12'>
                <section class='hero text-top-left' style='position:absolute;'>
                    <img src='../assets/images/dance/Pin-to-Pin-purple.png' style='margin-left: 110px; margin-top:-550px; width:75%;'>
                </section>
               </header>
           </article>

           <article class='row align-items-left' style='margin-top: 100px;'>
            <header class='col-6'>
                <section class='hero text-top-left' style='position:relative;'>
                        <p><b>Bugsy's</b><br> Bugsy's is a nightclub in Haarlem that is open Thursday - Sunday from 11PM- 5AM everyday.
                            There are different themes at this night club occasionally, most recently a Jazz theme. <br><b>Address: Smedestraat 19, 2011 RE Haarlem, Netherlands</b> </p>
                </section>
                </header>
            <header class='col-6'>
                <section class='hero text-top-left' style='position:relative;'>
                    <img src='../assets/images/dance/exploreHaarlem/bugsys.png' style='margin-left: 300px;'>
                </section>
            </header>
           </article>";

    }


}



?>