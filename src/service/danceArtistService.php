<?php
    include '../classes/autoloader.php';

    class danceArtistService {

        public function __construct() {
            $this->db = database::getInstance();
            $this->conn = $this->db->getConnection();
        }

        public function getAllDanceArtists()
        {
            $songService = new songService();
            $performanceService = new dancePerformanceService();

            $query = "SELECT * FROM Artists WHERE page_id = 2";
            $result = $this->conn->query($query);

            if($result)
            {
                $artists = array();
                while($row = $result->fetch_assoc())
                {
                    $artist = new danceArtist(
                    $row["artist_id"],
                    $row["name"],
                    $row["biography"],
                    $row["image"],
                    $row["thumbnail"],
                    $row["facebook"],
                    $row["instagram"],
                    $row["youtube"],
                    $songService->getSongsByArtistId((int)$row["artist_id"]),
                    $performanceService->getAllDancePerformancesByArtistId((int)$row["artist_id"])
                    );
                    $artists[] = $artist;
                }
                return $artists;
            }
        }

        public function getADanceArtistById(int $id)
        {
            $songService = new songService();
            $performanceService = new dancePerformanceService();

            $query = "SELECT * FROM Artists WHERE page_id = 2 AND artist_id='$id'";
            $result = $this->conn->query($query);

            if($result)
            {
                while($row = $result->fetch_assoc())
                {
                    $artist = new danceArtist(
                    $row["artist_id"],
                    $row["name"],
                    $row["biography"],
                    $row["image"],
                    $row["thumbnail"],
                    $row["facebook"],
                    $row["instagram"],
                    $row["youtube"],
                    $songService->getSongsByArtistId((int)$row["artist_id"]),
                    $performanceService->getAllDancePerformancesByArtistId((int)$row["artist_id"])
                    );
                    return $artist;
            }
        }
        }
    }
?>