<?php

class jazzArtistInfo
{
    private jazzArtist $artist;

    private string $artistName;
    private string $image;
    private string $biography;
    private string $instagram;
    private string $facebook;
    private string $youtube;

    public function __construct(jazzArtist $artist)
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
        echo "<section class='artistinfo--jazz'>
        <section class='artistinfo--jazz__artistImg'>
            <img src='$this->image' alt='' >
        </section>
        <section>
            <p class='artistinfo--jazz__breadCrumb'><a href='jazzEvent.php'>Jazz Artists</a> > $this->artistName</p>
            <section class='artistinfo--jazz__textContainer'>
                <section class='artistinfo--jazz__infoText'>
                    <h1 class='title title--page jazz'> $this->artistName</h1>
                    <p>
                        $this->biography
                    </p>
                    <section class='artistinfo--jazz__socialMediaContainer'>";
            if($this->instagram != " "){
                echo "<a href='$this->instagram' target='_blank'><img src='../assets/images/jazz/icons/jazz-instagram.png' alt='' class='artistinfo--jazz__socialMediaIcons'></a>";}
            if($this->facebook != " ")                       
                echo "<a href='$this->facebook' target='_blank'><img src='../assets/images/jazz/icons/jazz-facebook.png' alt='' class='artistinfo--jazz__socialMediaIcons'></a>";
            if($this->youtube != " ")
                echo "<a href='$this->youtube' target='_blank'><img src='../assets/images/jazz/icons/jazz-youtube.png' alt='' class='artistinfo--jazz__socialMediaIcons'></a>";
            echo"
                    <a href='#performances'><button class='artistinfo--jazz__ticketButton'>Get Your Tickets</button></a>
                </section>
                </section>
            </section>
            </section>
        </section>
    </section>";
    }
}


?>