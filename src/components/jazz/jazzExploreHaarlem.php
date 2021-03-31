<?php
class jazzExploreHaarlem
{
    public function render()
    {
        echo "
        <section class='container section exploreHaarlem--jazz'>
            <article class='exploreHaarlem--jazz__textBox'>
                <h1>Explore <span class='exploreHaarlem--jazz__haarlem'>Haarlem</span> before the event! And meet like-minded people</h1>
                <p>Did you know that in Haarlem there are many Jazz-cafes for a Jazz lover like you? 
                    We have found the closest two for you to check out and if you want, meet up with people
                    that have the same interests as you!</p>
            </article>

            <article class='exploreHaarlem--jazz__container'>
                <section class='exploreHaarlem--jazz__img'>
                    <img src='../assets/images/jazz/exploreHaarlem/la-pien-noir.png' alt=''>
                </section>

                <section class='exploreHaarlem--jazz__text'>
                    <h2>La Pien Noir</h2>
                    <p>At La Pien Noir, you can enjoy a cozy jazz sessions with well-musicians as well as new talents 
                        almost every evening. The café also opens its doors for new musicians, so get ready for fresh 
                        tastes!</p>
                    <b>
                        Address: Koningstraat 58 Haarlem, Netherlands
                    </b><br>
                    <img class ='exploreHaarlem--jazz__icon' src='../assets/images/jazz/icons/walking-man.png' alt=''>
                    <b>6 min (550 m) From Patronaat</b>
                </section>
            </article>

            <article class='exploreHaarlem--jazz__container'>
                <section class='exploreHaarlem--jazz__textLeft'>
                    <h2>Café Stiel's</h2>
                    <p>Café Stiel's, without exception, has been one of the most  swinging and busiest  cafés for more 
                        than 23 years and it distinguishes itself by organizing live music 6 days a week.   </p>
                    <b>
                        Address: Smedesstraat 21 Haarlem, Netherlands
                    </b><br>
                    <img class ='exploreHaarlem--jazz__icon' src='../assets/images/jazz/icons/walking-man.png' alt=''>
                    <b>7 min (650 m) - From Patronaat</b>
                </section>
                <section class='exploreHaarlem--jazz__imgRight'>
                    <img src='../assets/images/jazz/exploreHaarlem/cafe-stiels.png' alt=''>
                </section>
            </article>
        </section>";
    }
}
?>