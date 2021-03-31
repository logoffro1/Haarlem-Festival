<?php
include '../classes/autoloader.php';
class danceJazzSuggestion
{
    private string $artistName;
    private int $artistID;
    private string $performanceLink;
    private string $artistThumbnail;
    private array $performances;
    private string $page;

    public function __construct(string $artistName, string $artistThumbnail, int $artistID,array $performances, string $page)
    {
        $this->artistName = $artistName;
        $this->artistID = $artistID;
        $this->page = $page;
        if($this->page == "jazz")
            $this->performanceLink = sprintf('danceArtistOverview.php?artist=%s', $this->artistID);
        else if($this->page == "dance")
            $this->performanceLink = sprintf('jazzArtistOverview.php?artist=%s', $this->artistID);
        $this->artistThumbnail = $artistThumbnail;
        $this->performances = $performances;
        
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function getDayOfMonth()
    {
        return intval(explode(' ',$this->__get('performanceDate'))[0]);
    }

    //create artist card + event times on artist overview page
    public function render()
    {
        echo "
        <section class='container section'>
        <article class='row align-items-left'>
            <header class='col-6' style='border-color: white;'>
                <section class='hero text-top-left' style='position:relative;' id='artists'>
                    <img src='$this->artistThumbnail' style='margin-left:150px; width:40%; height:auto; border-radius:12px;'>
               </header>
               <header class='col-6' style='font-size:26px;'>
                <article class='row align-items-left'>
                    <header class='col-12'>";
                    if($this->page == "dance")
                        echo "<h1 style='color: black;'class='title title--page jazz'>$this->artistName</h1>";
                    else if($this->page == "jazz")
                    echo "<h1 style='color: black;'class='title title--page dance'>$this->artistName</h1>";
                
                echo"
                    </header>
                </article>
                <article class='row align-items-left'>

                    <header class='col-5'>
                        WHEN
                    </header>
                    <header class='col-3'>
                        WHERE
                    </header>
                </article>
                ";
                foreach($this->performances as $performance)
                {
                    $day = $performance -> getDayOfWeek();
                    $date = $performance -> getDate();
                    $time = $performance -> getTime();
                    $location = $performance->getLocation();
                    echo"<article class='row align-items-left'>
                    <header class='col-5'>
                    $date $time |
                    </header>
                    <header class='col-5'>
                    $location |
                    </header>
                </article>
                ";
                }
                echo"
                <article class='row align-items-left' style='margin-top:50px;'>
                <header class='col-5'>
                    <a class='button' href='$this->performanceLink'>Learn More</a>
                </header>
            </article>";
                echo "</header>";
                echo "</section>";
    }
}
?>