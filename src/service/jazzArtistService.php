<?php 
    include '../classes/autoloader.php';

    class jazzArtistService {

        public function __construct() {
            $this->db = database::getInstance();
            $this->conn = $this->db->getConnection();
        }
    
        public function getAnArtistById(int $id)
        {
            $songService = new songService();
            $query = "SELECT * FROM Artists WHERE artist_id='$id'";
            $result = $this->conn->query($query);

            if($result)
            {
                while($row = $result->fetch_assoc())
                {
                    $artist = new jazzArtist(
                    $row["artist_id"],
                    $row["name"],
                    $row["biography"],
                    $row["image"],
                    $row["thumbnail"],
                    $row["facebook"],
                    $row["instagram"],
                    $row["youtube"],
                    $songService->getSongsByArtistId((int)$row["artist_id"]),
                    );
                    return $artist;
            }
        }
    
        }
    }
?>