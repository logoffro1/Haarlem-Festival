<?php
include '../classes/autoloader.php';
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

    //creating the artist intro panel on the individual artist page using data fetched from the db
    public function render()
    {
        echo "<section class='container section' style='padding: 0px; padding-top: 90px; margin: 0px;'>
        <article class='row'>
            <header class='col-8'>
                <span>
               <img src='$this->image' alt='' style='position:relative;'>
               </span>
               </header>
               <header class='col-4'>
               <nav class='breadcrumbs'>
               <ul>
                   <li class='breadcrumbs__breadcrumb'><a href='../views/danceEvent.php'>Artist Overview</a></li>
                   <li class='breadcrumbs__breadcrumb'><a href='#'>$this->artistName</a></li>
               </ul>
           </nav>
               <span>
               <img src='../assets/images/dance/Rectangle 112.png' alt='' style='position:relative; margin-top: 75px; margin-left: -60%; margin-bottom:30px;'>
               <span style='position:absolute; top:250px; right:400px;'>
               <h1 class='title title--page dance' >$this->artistName</h1>
               <p style='position:relative; width:500px; margin-bottom:150px;'>$this->biography</p>
               <article class='row' style='position:relative;'>
               <a style='margin-right:35px; margin-top:7px;' href='$this->instagram'><img src='../assets/images/dance/icons/dance-instagram.png' alt=''></a>
               <a style='margin-right:35px; margin-top:7px;' href='$this->facebook'><img src='../assets/images/dance/icons/dance-facebook.png' alt=''></a>
               <a style='margin-right:35px; margin-top:7px;' href='$this->youtube'><img src='../assets/images/dance/icons/dance-youtube.png' alt=''></a>
               <a class='button' href='#performances'>Get your tickets</a>
               </span>
           </span>
               </header>
           </article>
       </section>
       ";
    }
}


?>