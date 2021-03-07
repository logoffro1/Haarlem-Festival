<?php 
    include '../classes/autoloader.php';

    class jazzArtistService {

        public function __construct() {
            $this->db = database::getInstance();
            $this->conn = $this->db->getConnection();
        }
    
        public function getAllJazzArtists()
        {
            $songService = new songService();
            $performanceService = new jazzPerformanceService();

            $query = "SELECT * FROM Artists WHERE page_id = 3";
            $result = $this->conn->query($query);

            if($result)
            {
                $artists = array();
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
                    $performanceService->getAllJazzPerformancesByArtistId((int)$row["artist_id"])
                    );
                    $artists[] = $artist;
                }
                return $artists;
            }
        }

        public function getAJazzArtistById(int $id)
        {
            $songService = new songService();
            $performanceService = new jazzPerformanceService();

            $query = "SELECT * FROM Artists WHERE page_id = 3 AND artist_id='$id'";
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
                    $performanceService->getAllJazzPerformancesByArtistId((int)$row["artist_id"])
                    );
                    return $artist;
            }
        }
    
        }
    }
?>