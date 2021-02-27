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
        echo "I am gay";
    }

}





?>