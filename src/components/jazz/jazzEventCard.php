<?php           

class jazzEventCard
{
    private string $artistName;
    private string $eventTime;
    private string $eventLoc;
    private string $eventDate;
    private string $eventLink;
    private string $eventImg;

    public function __construct(string $artistName, string $eventTime, string $eventLoc, string $eventDate, string $eventLink, string $eventImg)
    {
        $this->artistName = $artistName;
        $this->eventTime = $eventTime;
        $this->eventLoc = $eventLoc;
        $this->eventDate = $eventDate;
        $this->eventLink = $eventLink;
        $this->eventImg = $eventImg;
    }

    public function render()
    {
        echo "
        <article class='card--jazz'>
        <img src='$this->eventImg' class='card-jazz_img'>
            <section class='card-jazz_rightcontainer'>
                <p class='card--jazz__artist'>$this->artistName</p>
                <p class='card--jazz__time'>$this->eventTime</p>
                <p class='card--jazz__loc'><img src='../assets/images/svg/icons/location-icon.svg' style= 'margin-right:15px; opacity:0.5;'>$this->eventLoc</p>
                <img src='arrow image link' alt='' srcset=''></a>
            </section>
        </article>";
    }

}





?>