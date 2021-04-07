<?php
include '../classes/autoloader.php';
class dancePerformanceCard
{
    private string $artistName;
    private int $artistID;
    private string $performanceLink;
    private string $artistThumbnail;
    private array $performances;

    public function __construct(string $artistName, string $artistThumbnail, int $artistID,array $performances)
    {
        $this->artistName = $artistName;
        $this->artistID = $artistID;
        $this->performanceLink = sprintf('danceArtistOverview.php?artist=%s', $this->artistID);
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
            <header class='col-4' style='border-color: white;'>
                <section class='hero text-top-left' style='position:relative;' id='artists'>
                    <img src='$this->artistThumbnail' style='width:100%; height:auto; border-radius:12px;'>
               </header>
               <header class='col-7 col-offset-1' style='font-size:26px;'>
                <article class='row align-items-left'>
                    <header class='col-12'>
                        <h1 style='color: black;'class='title title--page dance'>$this->artistName</h1>
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
                    $price = number_format($performance->getPrice(), 2);
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
                    <a class='button' href='$this->performanceLink'> Get your tickets </a>
                </header>
            </article>";
                echo "</header>";
                echo "</section>";
    }
}
?>