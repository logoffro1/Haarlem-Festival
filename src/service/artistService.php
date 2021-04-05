<?php 
include '../classes/autoloader.php';

class artistService {
    private database $db;
    private mysqli $conn;
    private songService $songService;
    private performanceService $performanceService;
    private helper $helper;

    public function __construct() {
        $this->db = database::getInstance();

        $this->conn = $this->db->getConnection();

        $this->songService = new songService();
        $this->performanceService = new performanceService();
        $this->helper = new helper();
    }

    public function getJazzArtists() : array
    {
        return $this->getArtistList(4); // Todo change id to correct jazz page id in database
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
        $query = "SELECT * FROM Artists where page_id = $pageId"; // No user input, so binding would be redundant


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
                (int)$row["artist_id"], 
                $row["name"], 
                $row["biography"], 
                $row["image"],
                $row["thumbnail"],
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
        $query = "SELECT * FROM Artists where artist_id = $artistId"; // Todo: Create subselect and group songs and performances


        if ($result = $this->conn->query($query)) {
            $objectResult = $result->fetch_object();

            return $this->createArtist($objectResult);
        }

        return array();
    }

    public function getARandomDanceArtist()
    {
        $query = "SELECT * FROM Artists WHERE page_id=2 ORDER BY RAND() LIMIT 1";

        if ($result = $this->conn->query($query)) {
            $objectResult = $result->fetch_object();

            return $this->createArtist($objectResult);
        }

        return array();
    }

    public function getARandomJazzArtist()
    {
        $query = "SELECT * FROM Artists WHERE page_id=4 ORDER BY RAND() LIMIT 1";

        if ($result = $this->conn->query($query)) {
            $objectResult = $result->fetch_object();

            return $this->createArtist($objectResult);
        }

        return array();
    }


    public function getAllDataArtists(int $pageId)
    {
        $query = "SELECT * FROM Artists WHERE page_id = $pageId";
        $result = $this->conn->query($query);

        if($result)
        {
            $artists = array();
            while($row = $result->fetch_assoc())
            {
                $artist = new artist(
                    $row["artist_id"],
                    $row["name"],
                    $row["biography"],
                    $row["image"],
                    $row["thumbnail"],
                    $row["facebook"],
                    $row["instagram"],
                    $row["youtube"],
                    $this->songService->getSongsByArtistId((int)$row["artist_id"]),
                    $this->performanceService->createPerformances((int)$row["artist_id"])
                );
                $artists[] = $artist;
            }
            return $artists;
        }
    }

    /**
     * @param result - result of artist query limited to one
     * @return artist - all details of the artist
     */
    public function createArtist($result) : artist
    {
        $artistId = (int)$result->artist_id;
        $songs = $this->songService->getSongs($artistId);
        $performances = $this->performanceService->createPerformances($artistId);

        return new artist(
            $artistId,
            $result->name, 
            $result->biography, 
            $result->image, 
            $result->thumbnail, 
            $result->facebook, 
            $result->instagram, 
            $result->youtube,
            $songs,
            $performances
        );
    }

    /**
     * Adds artist to the database, based on url 'event' param interger
     * 
     * @param array $data - data from form post
     */
    public function addArtist(array $data) : void
    {
        // Build query
        $sql = "INSERT INTO Artists (page_id, name, biography) VALUES (?,?,?)";

        // Get connection and preapre statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $query->bind_param(
                "iss",
                $data['page_id'],
                $data['title'],
                $data['page_content']
            );

            // Execute query
            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception("Cannot add a new artist. please try again.");
        }
    }

    public function deleteArtist(int $artistId)
    {
        $sql = "DELETE FROM Artists WHERE artist_id=?";

        // Get connection and prepare statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $query->bind_param("i", 
                $id
            );

            $id = $artistId;

            // Execute query
            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception('Could not connect to the database. Please try again');
        }
    }
    /**
     * Updates the artist data, funciton used for both content and social media update.
     * 
     * @param artist $artist - active artist o page
     * @param array $data - data from form post
     */
    public function updateArtist(artist $artist, array $data) : void
    {
        $sql = "UPDATE Artists 
                    SET name=?, 
                        biography=?, 
                        facebook=?,
                        instagram=?,
                        youtube=?
                WHERE artist_id = $artist->id";

        // Get connection and prepare statement
        if($query = $this->conn->prepare($sql)) {
            // Social or content can be null, but will both be updated, so we need to check for values not present in post request
            $title = $data['title'] ?? $artist->name;
            $page_content = $data['page_content'] ?? $artist->biography;
            $facebook = $data['facebook'] ?? $artist->facebook;
            $instagram = $data['instagram'] ?? $artist->instagram;
            $youtube = $data['youtube'] ?? $artist->youtube;
            
            // Create bind params to prevent sql injection
            $query->bind_param("sssss", 
                $title,
                $page_content,
                $facebook,
                $instagram,
                $youtube
            );

            // Execute query
            $query->execute();

            $this->helper->refresh();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception('Could not update the artist. Please try again');
        }
    }

     /**
     * Updates the artist image path
     * 
     * @param artist $artist - active artist o page
     * @param array $data - data from form post
     */
    public function updateArtistImage(artist $artist, array $data)
    {
        $columnName = $data['type'];

        $sql = "UPDATE Artists 
                    SET $columnName=?
                WHERE artist_id = $artist->id";

        $isNewImage = isset($data['image']['name']) && strlen($data['image']['name']) > 0;

        if($isNewImage){
            $image = UPLOAD_FOLDER.'/'.$data['image']['name'] ?? null;
        } else {
            $image = $artist->$columnName;
        }

        // Get connection and prepare statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $query->bind_param("s",
                $image    
            );

            // Execute query
            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception('Could not update the artist image. Please try again');
        }
    }

     /**
     * Deletes the artist image path
     * 
     * @param artist $artist - active artist o page
     * @param array $data - data from form post
     */
    public function deleteArtistImage(artist $artist, array $data)
    {
        $columnName = $data['type'];

        $sql = "UPDATE Artists 
                    SET $columnName=?
                WHERE artist_id = $artist->id";

        // Get connection and prepare statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $query->bind_param("s",
                $image    
            );

            $image = null;

            // Execute query
            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception('Could not update the artist image. Please try again');
        }
    }

     /**
     * Uploads the image to the upload folder
     * 
     * @param array $data - image data from form post
     * @return bool - check if upload was succesfull
     */
    public function uploadImage(array $data)
    {
        $this->db->uploadImage($data['image']['tmp_name'], $data['image']['name']);
    }
    
     /**
     * Deletes the image to the upload folder
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