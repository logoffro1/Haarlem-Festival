<?php           
class jazzPerformanceCard
{
    private string $artistName;
    private string $performanceTime;
    private string $performanceLoc;
    private string $performanceDate;
    private string $performanceLink;
    private string $artistThumbnail;

    public function __construct(jazzPerformance $performance, string $artistName, string $artistThumbnail)
    {
        $this->artistName = $artistName;
        $this->performanceTime = $performance->getTime();
        $this->performanceLoc = $performance->getLocation();
        $this->performanceDate = $performance->getDate();
        $this->performanceLink = "#";
        $this->artistThumbnail = $artistThumbnail;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function getDayOfMonth()
    {
        return intval(explode(" ",$this->__get('performanceDate'))[0]);
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