<?php           

class jazzComboBox
{
    private array $artists;
    private array $dates;

    public function __construct(array $artists, array $dates)
    {
        $this->artists = $artists;
        $this->dates = $dates;
    }

    public function render()
    {
        echo "
        <section class='cmb--jazz'>
            <select class='cmb--jazz__box'>
                <option value='allArtist'>All Artists</option>";
        foreach($this->artists as $artist)
        {
            echo "<option value='$artist'>$artist</option>";
        }
        echo "
        </select>
            <select select class='cmb--jazz__box'>
                <option value='allDate'>Date</option>";
        foreach($this->dates as $date)
        {
            echo "<option value='$date'>$date</option>";
        }
        echo "
            </select>
        </section>      
        ";
    }
}



?>
