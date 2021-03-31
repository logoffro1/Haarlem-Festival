<?php
include '../classes/autoloader.php';
class danceSongCard
{
    private array $songs;
    private string $artistName;

    public function __construct(array $songs, string $artistName)
    {
        $this->songs = $songs;
        $this->artistName = $artistName;
    }

    //create song card on individual artist page
    public function render()
    {
        echo "
        <section class='container section' style='padding-top: 0px; padding-left:7%; padding-right:7%;'>
        <article class='row align-items-left'>
            <header class='col-12'>
                <section class='hero text-top-left' style='position:relative;''>
                    <h1 style='margin-top: 60px; margin-left: 0px;'class='title'>Explore the Music</h1>
                </section>
               </header>
           </article>
            <article class='row align-items-left'>
            <a id='performances'></a>";

        foreach($this->songs as $song)
        {
            $songName = $song->__get('title');
            $url = $song->__get('url');
            $img = $song->__get('image');
                echo"
                <header class='col-3'>
                <section style='position:relative;'>
                <span>
                <a href='$url'>
                <img src='$img' style='margin-right :10px;'>
                <img style='position:absolute; margin-top:-250px; margin-left: 150px;'  src='../assets/images/dance/icons/songs-play-button.png'>
                <p style='color:grey;'>$songName</p>
            </a>
            </span>
                </section>
               </header>";
        }
        echo "</article>
        </section>
        </section>";
    }
}
?>