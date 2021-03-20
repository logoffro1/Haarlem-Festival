<?php

class jazzSongCard
{
    private array $songs;
    private string $artistName;

    public function __construct(array $songs, string $artistName)
    {
        $this->songs = $songs;
        $this->artistName = $artistName;
    }

    public function render()
    {
        echo "
        <section class='container section' id='songs'>
            <h1>Explore The Music</h2>
            <section class='artistSongs--jazz'>";

        foreach($this->songs as $song)
        {
            $songName = $song->__get('title');
            $url = $song->__get('url');
            $img = $song->__get('image');
            echo "
            <section class='artistSongs--jazz__cardSection'>
                    <a href='$url'>
                        <img class='artistSongs--jazz__songPic' src='$img' alt=''>
                        <img class='artistSongs--jazz__playIcon'  src='../assets/images/jazz/icons/songs-play-button.png'>
                    </a>
                    <p>$this->artistName - $songName</p>
                </section>";
        }
        echo "</section>
        </section>";
    }
}
?>