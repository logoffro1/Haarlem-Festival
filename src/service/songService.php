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

        public function addSong(array $data, int $id) : void
        {
            $sql = "INSERT INTO songs (artist_id, url, title, image) VALUES (?,?,?,?)";

            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("isss", 
                    $id,
                    $data['url'],
                    $data['title'],
                    $image
                );

                $image = $data['image']['name'] ?? null;

                if($image == null){
                    $query->execute();
                    return;
                }

                if($this->db->uploadImage($data['image']['tmp_name'], $data['image']['name'])){
                    // Execute query
                    $query->execute();
                } else {
                    throw new Exception('Could not add the song. Please try again');
                }
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not create a new song. Please try again');
            }
        }

        public function deleteSong(song $song)
        {
            $sql = "DELETE FROM songs WHERE song_id=?";

            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("i", 
                    $id
                );

                $id = $song->id;

                if($song->image == null){
                    $query->execute();
                    return;
                }

                if($this->db->deleteImage($song->image)){
                    // Execute query
                    $query->execute();
                } else {
                    throw new Exception('Could not delete the song. Please try again');
                }
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not connect to the database. Please try again');
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

                $this->db->uploadImage($data['image']['tmp_name'], $data['image']['name']);
                // Execute query
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not connect to the database. Please try again');
            }
        }

        public function deleteSongImage(song $song) : void
        {
            $sql = "UPDATE songs SET image=? WHERE song_id=?";

            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $emptyImage = '';
                $query->bind_param("si",
                    $emptyImage,
                    $songIdParam
                );

                $songIdParam = $song->id;

                // Execute query
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not connect to the database. Please try again');
            }
        }

        /**
         * Deletes the song in the upload folder
         * 
         * @param string $name - name of the image that needs to be delete
         * @return bool - check if deletion was succesfull
         */
        public function deleteImage(string $name) : bool
        {
            return $this->db->deleteImage($name);
        }
    }
?>