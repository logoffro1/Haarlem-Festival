<?php

class artistInfo
{
    private artist $artist;
    private string $type;
    private string $url;

    private string $artistName;
    private string $image;
    private string $biography;
    private string $instagram;
    private string $facebook;
    private string $youtube;

    public function __construct(artist $artist, string $type)
    {
        $this->artist = $artist;
        $this->type = ucwords($type);
        $this->url = $this->getUrl();

        $this->artistName = $this->artist->__get('name');
        $this->image = $this->artist->__get('image') ?? '';
        $this->biography = $this->artist->__get('biography') ?? '';
        $this->instagram = $this->artist->__get('instagram') ?? '';
        $this->facebook = $this->artist->__get('facebook') ?? '';
        $this->youtube = $this->artist->__get('youtube') ?? '';
    }

    public function render()
    {
        echo "
        <section class='artistinfo--jazz'>
            <section class='artistinfo--jazz__artistImg' style='background-image: url($this->image)'>
            </section>
            <section class='col-5 col-offset-6'>
                <p class='artistinfo--jazz__breadCrumb'><a href='$this->url'>$this->type Artists</a> > $this->artistName</p>
                <section class='artistinfo--jazz__textContainer'>
                    <section class='artistinfo--jazz__infoText'>
                        <h1 class='title title--page $this->type'> $this->artistName</h1>
                        <p>
                            $this->biography
                        </p>
                        <section class='artistinfo--jazz__socialMediaContainer'>";
                            //If the artist has no social media on a specific platform, its logo is not being displayed
                            if($this->instagram != ""){
                                echo "<a href='$this->instagram' target='_blank'><img src='../assets/images/$this->type/icons/$this->type-instagram.png' alt='' class='artistinfo--jazz__socialMediaIcons'></a>";
                            }
                            if($this->facebook != ""){                   
                                echo "<a href='$this->facebook' target='_blank'><img src='../assets/images/$this->type/icons/$this->type-facebook.png' alt='' class='artistinfo--jazz__socialMediaIcons'></a>";
                            }
                            if($this->youtube != ""){
                                echo "<a href='$this->youtube' target='_blank'><img src='../assets/images/$this->type/icons/$this->type-youtube.png' alt='' class='artistinfo--jazz__socialMediaIcons'></a>";
                            }
                            echo"
                            <a href='#performances' class='button artistinfo--jazz__ticketButton'>Get Your Tickets</a>
                        </section>
                    </section>
                </section>
            </section>
        </section>";
    }

    private function getUrl()
    {
        return strtolower($this->type) == 'jazz' ? '/views/jazzEvent.php' : '/views/danceEvent.php';
    }
}


?>