<?php
@include '../assets/componenets/danceEvent/__danceArtistInfo.scss';
@include '../assets/componenets/danceEvent/__danceEventComps.scss';
@include '../assets/componenets/danceEvent/__danceArtistPerformances.scss';
@include '../assets/componenets/danceEvent/__danceArtistSongs.scss';
@include '../assets/componenets/danceEvent/__danceCombobox.scss';
@include '../assets/componenets/danceEvent/__danceExploreHaarlem.scss';
@include '../assets/componenets/danceEvent/__danceSwoosh.scss';
class danceArtistPerformances
{
    private array $performances;
    public function __construct(array $performances)
    {
        $this->performances = $performances;
    }

    function render()
    {
        echo "
        <section class='container-fluid section' style='padding-top: 0px; padding-left:10%; padding-right:10%;'>
        <article class='row align-items-left'>
            <header class='col-3'>
                <section class='hero text-top-left' style='position:relative;'>
                    <p class='ticket-list header' style='margin:0px;'>WHEN</p>
                </section>
               </header>

            <header class='col-3'>
                <section class='hero text-top-left' style='position:relative;'>
                    <p style='margin:0px;'>WHERE</p>
                </section>
               </header>


            <header class='col-3'>
                <section class='hero text-top-left' style='position:relative;'>
                    <p style='margin:0px;'> Price</p>
                </section>
               </header>
               </article>";

        foreach($this->performances as $performance)
        {
            $day = $performance -> getDayOfWeek();
            $date = $performance -> getDate();
            $time = $performance -> getTime();
            $location = $performance->getLocation();
            $price = number_format($performance->getPrice(), 2);


            echo 		   "<article class='row align-items-left' style='margin-bottom:15px;'>
            <header class='col-3'>
            <p style='margin:0px; font-size:26px;'>$date | $time</p>
            </header>
            <header class='col-3'>
             <p style='margin:0px; font-size:26px;'>$location</p>
             </header>
             <header class='col-3'>
                 <p style='margin:0px;font-size:26px;'>€$price</p>
                 </header>
                 <header class='col-3'>
                     <button style='width:200px; height:100%;'>Get your tickets</button>
                     </header>
            </article>";
        }

        echo "
            </section>";
    }
}

?>