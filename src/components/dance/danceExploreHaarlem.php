<?php
include '../classes/autoloader.php';
class danceExploreHaarlem
{
    //create explore haarlem text block + images
    public function render()
    {
        echo "
           <section class='container section exploreHaarlem'>
               <article class='exploreHaarlem__textBox'>
                   <h1>Explore <span class='exploreHaarlem__haarlem exploreHaarlem__haarlem--dance'>Haarlem</span> before the event! And meet like-minded people</h1>
                   <p>Did you know that in Haarlem there are many Jazz-cafes for a Jazz lover like you? 
                       We have found the closest two for you to check out and if you want, meet up with people
                       that have the same interests as you!</p>
               </article>
   
               <article class='exploreHaarlem__container'>
                   <section class='exploreHaarlem__img'>
                       <img src='../assets/images/dance/exploreHaarlem/letz party.png' alt=''>
                   </section>
   
                   <section class='exploreHaarlem__text'>
                       <h2>Letz Party</h2>
                       <p>Letz Party is a club for all, open from 8:30PM - 1:30AM on the Weekends.
                       This is perfect stay for you to relax before or after one of our crazy dance events. <br><b>Address: Gasthuisstraat 36, 2011 XP Haarlem, Netherlands</b> </p>
             
                       <b>
                           Address: Koningstraat 58 Haarlem, Netherlands
                       </b>
                   </section>
               </article>
   
               <article class='exploreHaarlem__container'>
                   <section class='exploreHaarlem__textLeft'>
                       <h2>Bugsy's</h2>
                       <p>Bugsy's is a nightclub in Haarlem that is open Thursday - Sunday from 11PM- 5AM everyday.
                       There are different themes at this night club occasionally, most recently a Jazz theme.</p>
                       <br>
                       <b>Address: Smedestraat 19, 2011 RE Haarlem, Netherlands</b>
                       <br>
                   </section>
                   <section class='exploreHaarlem__imgRight'>
                       <img src='../assets/images/dance/exploreHaarlem/bugsys.png' alt=''>
                   </section>
               </article>
           </section>";

    }


}



?>