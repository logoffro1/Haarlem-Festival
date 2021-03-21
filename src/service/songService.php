<?php
    include '../classes/autoloader.php';
	include '../models/song.php';

    class songService  {

    public function __construct()
    {
        $this->db = database::getInstance();
        $this->conn = $this->db->getConnection();
    }

    public function getSongsByArtistId(int $id)
    {
        $query = "SELECT * FROM Songs WHERE artist_id = '$id'";
        $result = $this->conn->query($query);

        if($result)
        {
            $songs = array();
            while($row = $result->fetch_assoc())
                {
                    $song = new song(
                        $row["song_id"],
                        $row["artist_id"],
                        $row["title"],
                        $row["image"],
                        $row["url"]
                    );
                    $songs[]=$song;
                }
                return $songs;
            }
        }
    }

?>