<?php
include_once '../config/config.php';

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
        public function getSongs(int $artistId) : array
        {       
            $query = "SELECT * FROM songs where artist_id = $artistId";

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

        public function getSong(int $songId) : ?song
        {       
            $query = "SELECT * FROM songs WHERE song_id=? LIMIT 1";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $songId);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result->num_rows == 0){
                return null;
            }

            $objectResult = $result->fetch_object();

            return new song(
                (int)$objectResult->song_id, 
                $objectResult->image, 
                $objectResult->title, 
                $objectResult->url
            );
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

        public function updateSong(int $songId, array $data) : void
        {
            $sql = "UPDATE songs SET url=?, title=?, image=? WHERE song_id=?";

            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("sssi", 
                    $data['url'],
                    $data['title'],
                    $data['image']['name'],
                    $songId
                );

                move_uploaded_file($data['image']['tmp_name'], UPLOAD_PATH.$data['image']['name']);

                // Execute query
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not update song. Please try again');
            }
        }
    }
?>