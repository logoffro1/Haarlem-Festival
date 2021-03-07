<?php           
class jazzPerformanceCard
{
    private string $artistName;
    private string $eventTime;
    private string $eventLoc;
    private string $eventDate;
    private string $eventLink;
    private string $eventThumbnail;

    public function __construct(jazzPerformance $performance)
    {
        $this->artistName = $performance->getArtistName();
        $this->eventTime = $performance->getTime();
        $this->eventLoc = $performance->getLocation();
        $this->eventDate = $performance->getDate();
        $this->eventLink = "#";
        $this->eventThumbnail = $performance->getThumbnail();
    }

    public function render()
    {
        echo "
        <a href='$this->eventLink' >
        <article class='card--jazz'>
            <section class='card-jazz_img'>
                <img src='$this->eventThumbnail' class=''>
            </section>
            <section class='card-jazz_rightcontainer'>
                <p class='card--jazz__artist'>$this->artistName</p>
                <p class='card--jazz__time'>$this->eventTime</p>
                <p class='card--jazz__loc'><img src='../assets/images/svg/icons/location-icon.svg' style='margin-right:15px; opacity:0.5;'>$this->eventLoc</p>
                <img class='card--jazz__arrow' src='../assets/images/jazz/icons/jazz-card-arrow.png' alt='' srcset=''>
                <p class='card--jazz__date'>$this->eventDate</p>  
            </section>   
        </article>
        </a>   
";
    }

}





?>