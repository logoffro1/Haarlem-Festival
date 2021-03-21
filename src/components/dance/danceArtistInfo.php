<?php

class danceArtistInfo
{
    private danceArtist $artist;

    private string $artistName;
    private string $image;
    private string $biography;
    private string $instagram;
    private string $facebook;
    private string $youtube;

    public function __construct(danceArtist $artist)
    {
        $this->artist = $artist;

        $this->artistName = $this->artist->__get('artistName');
        $this->image = $this->artist->__get('image');
        $this->biography = $this->artist->__get('biography');
        $this->instagram = $this->artist->__get('instagram');
        $this->facebook = $this->artist->__get('facebook');
        $this->youtube = $this->artist->__get('youtube');
    }


    public function render()
    {
        echo "<section class='artistinfo--dance'>
        <section class='artistinfo--dance__artistImg'>
            <img src='$this->image' alt='' >
        </section>
        <section>
            <p class='artistinfo--dance__breadCrumb'><a href='danceEvent.php'>Dance Artists</a> > $this->artistName</p>
            <section class='artistinfo--dance__textContainer'>
                <section class='artistinfo--dance__infoText'>
                    <h1 class='title title--page dance'> $this->artistName</h1>
                    <p>
                        $this->biography
                    </p>
                    <section class='artistinfo--dance__socialMediaContainer'>
                    <a href='$this->instagram'><img src='../assets/images/dance/icons/dance-instagram.png' alt='' class='artistinfo--dance__socialMediaIcons'></a>
                    <a href='$this->facebook'><img src='../assets/images/dance/icons/dance-facebook.png' alt='' class='artistinfo--dance__socialMediaIcons'></a>
                    <a href='$this->youtube'><img src='../assets/images/dance/icons/dance-youtube.png' alt='' class='artistinfo--dance__socialMediaIcons'></a>
                    <a href='#performances'><button class='artistinfo--dance__ticketButton'>Get Your Tickets</button></a>
                </section>
                </section>
            </section>
            </section>
        </section>
    </section>";
    }
}


?>