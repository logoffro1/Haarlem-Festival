<?php 
include '../classes/autoloader.php';

class artistService {
    private database $db;
    private mysqli $conn;

    public function __construct() {
        $this->db = database::getInstance();

        $this->conn = $this->db->getConnection();
    }

    public function getJazzArtists() : array
    {
        return $this->getArtistList(1); // Todo change id to correct jazz page id in database
    }

    public function getDanceArtists() : array
    {
        return $this->getArtistList(2); // Todo change id to correct jazz page id in database
    }

    /**
     * @param pageId - page id of the jazz or dance page
     * @return array artists - list of artist without their songs, because it will not be shown in the list
     */
    public function getArtistList(int $pageId) : array {
        $query = "SELECT * FROM artists where page_id = $pageId"; // No user input, so binding would be redundant


        if ($result = $this->conn->query($query)) {
            return $this->createArtistList($result);
        }

        return array();
    }

    /**
     * @param result - result of artists query
     * @return array artists - list of artist without their songs, because it will not be shown in the list
     */
    public function createArtistList($result) : array
    {
        $artistList = array();
            
        // fetch results, and loop over it
        while($row = $result->fetch_assoc()) {
            // Create page classes based on data
            $artist = new artist(
                (int)$row["id"], 
                $row["name"], 
                $row["biography"], 
                $row["image"], 
                $row["facebook"], 
                $row["instagram"], 
                $row["youtube"], 
            );

            // add new page to list
            $artistList[] = $artist;
        }

        // return array 
        return $artistList;
    }

    /**
     * @param artistId - id of an artist
     * @return artist - specific details of the artist
     */
    public function getArtist(int $artistId)
    {
        $query = "SELECT * FROM artists where artist_id = $artistId"; // Todo: Create subselect and group songs and performances


        if ($result = $this->conn->query($query)) {
            $objectResult = $result->fetch_object();

            return $this->createArtist($objectResult);
        }

        return array();
    }

    /**
     * @param result - result of artist query limited to one
     * @return artist - all details of the artist
     */
    public function createArtist($result) : artist
    {
        $artistId = (int)$result->artist_id
        $songs = $this->createSongs($artistId);
        $performances = $this->createPerformances($artistId);

        return new artist(
            $artistId
            $result->name, 
            $result->biography, 
            $result->image, 
            $result->facebook, 
            $result->instagram, 
            $result->youtube,
            $songs,
            $performances
        );
    }

    /**
     * @param result - array of songs from artist query limited to one
     * @return array<song> - all songs of the artist
     */
    public function createSongs($artistId) : array
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

    
    /**
     * @param result - array of performances from artist query limited to one
     * @return array<performance> - all performances of the artist
     */
    public function createPerformances($artistId) : array
    {       
        $performances = array();


        $query = "SELECT * FROM performances where artist_id = $artistId"; // No user input, so binding would be redundant

        if ($result = $this->conn->query($query)) {
            $performances = array();
                
            // fetch results, and loop over it
            while($row = $result->fetch_assoc()) {
                // Create page classes based on data

                $performance = new performance(
                    (int)$row["performance_id"], 
                    $row["date"], 
                    $row["time"], 
                    $row["duration"],
                    $row["availableTickets"]
                );
    
                // add new page to list
                $performances[] = $performance;
            }
    
            // return array 
            return $performances;
        }

        foreach ($performance as $result->performances) {
            $id = $performance[0];
            $date = $performance[1];
            $time = $performance[2];
            $type = $performance[3];
            $duration = $performance[4];
            $tickets = $performance[5];
            $location = $this->createLocation($performance[6]);
        }

        return $performances;
    }

    public function createLocation($result) : location
    {
        $id = (int)$result[0];
        $name = $result[1];
        $address = $result[2];
        $hallName = $result[3] ?? "";
        $seats = (int)$result[4];
        $price = (double)$result[5];

        return new location(
            $id,
            $name,
            $address,
            $hallName,
            $seats,
            $price
        );
    }

    public function updateArtistContent(artist $artist)
    {
        $sql = "UPDATE artists 
                    SET [name]=?, 
                        biography=?, 
                        [image]=?,
                        [facebook]=?,
                        [instagram]=?,
                        [youtube]=?
                WHERE artist_id = $artist->id";

        // Get connection and prepare statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $query->bind_param("ssssss", 
                $artist->name,
                $artist->biography,
                $artist->image,
                $artist->facebook,
                $artist->instagram,
                $artist->youtube
            );

            // Execute query
            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception('Could not update the artist. Please try again');
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

    public function addPerformance(artist $artist, $data) : void
    {
        $sql = "INSERT INTO performances (location_id, artist_id, date, time, type, duration, tickets) VALUES (?,?,?,?,?,?,?)";

        // Get connection and prepare statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $query->bind_param("iisssii", 
                $data['location'],
                $artist->id,
                $data['date'],
                $data['time'],
                $data['type'],
                $data['duration'],
                $data['tickets'],
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