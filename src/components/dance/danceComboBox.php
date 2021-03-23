<?php
include '../classes/autoloader.php';
class danceComboBox
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
        <section class='cmb--dance'>
        <form action='' method='get'>
            <select name='artist' class='cmb--dance__box'>
                <option value='allArtists'>All Artists</option>";
        foreach($this->artists as $artist)
        {
            echo "<option value='$artist'>$artist</option>";
        }
        echo "
        </select>
            <select name='date' class='cmb--dance__box'>
                <option value='allDates'>Date</option>";
        foreach($this->dates as $date)
        {
            echo "<option value='$date'>$date</option>";
        }
        echo "
        <input class='button cmb--dance__button' type='submit' name='submit' value='Search'>
            </select>
        </section>
        </form>
        ";
    }
}



?>
