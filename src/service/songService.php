<?php
    class songService {
        private database $db;
        private mysqli $conn;
    
        public function __construct() {
            $this->db = database::getInstance();
    
            $this->conn = $this->db->getConnection();
        }

        /**
         * @param result - array of songs from artist query limited to one
         * @return array<song> - all songs of the artist
         */
        public function getSongs($artistId) : array
        {       
            $query = "SELECT * FROM songs where artist_id = $artistId"; // No user input, so binding would be redundant

            if ($result = $this->conn->query($query)) {
                $songList = array();
                    
                // fetch results, and loop over it
                while($row = $result->fetch_assoc()) {
                    // Create page classes based on data

                    $song = new song(
                        (int)$row["song_id"], 
                        $row["image"], 
                        $row["title"], 
                        $row["url"]
                    );
        
                    // add new page to list
                    $songList[] = $song;
                }
        
                // return array 
                return $songList;
            }
        }

        public function addSong(int $artistId, string $title, string $url, string $image) : void
        {
            $sql = "INSERT INTO songs (artist_id, url, title, image) VALUES (?,?,?,?)";

            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("isss", 
                    $artistId,
                    $url,
                    $title,
                    $image
                );

                // Execute query
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not create a new song. Please try again');
            }
        }
    }
?>