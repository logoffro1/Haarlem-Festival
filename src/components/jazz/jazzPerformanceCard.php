<?php           
class jazzPerformanceCard
{
    private string $artistName;
    private string $eventTime;
    private string $eventLoc;
    private string $eventDate;
    private string $eventLink;
    private string $eventThumbnail;

    public function __construct(jazzPerformance $performance, string $artistName, string $artistThumbnail)
    {
        $this->artistName = $artistName;
        $this->performanceTime = $performance->getTime();
        $this->performanceLoc = $performance->getLocation();
        $this->performanceDate = $performance->getDate();
        $this->performanceLink = "#";
        $this->artistThumbnail = $artistThumbnail;
    }

    public function render()
    {
        echo "
        <a href='$this->performanceLink' >
        <article class='card--jazz'>
            <section class='card-jazz_img'>
                <img src='$this->artistThumbnail' class=''>
            </section>
            <section class='card-jazz_rightcontainer'>
                <p class='card--jazz__artist'>$this->artistName</p>
                <p class='card--jazz__time'>$this->performanceTime</p>
                <p class='card--jazz__loc'><img src='../assets/images/svg/icons/location-icon.svg' style='margin-right:15px; opacity:0.5;'>$this->performanceLoc</p>
                <img class='card--jazz__arrow' src='../assets/images/jazz/icons/jazz-card-arrow.png' alt='' srcset=''>
                <p class='card--jazz__date'>$this->performanceDate</p>  
            </section>   
        </article>
        </a>   
";
    }

}





?>