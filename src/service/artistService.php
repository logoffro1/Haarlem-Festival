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
        $artistId = (int)$result->artist_id;
        $songs = $this->songService->getSongs($artistId);
        $performances = $this->performanceService->createPerformances($artistId);

        return new artist(
            $artistId,
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

    public function updateArtist(artist $artist, array $data)
    {
        $sql = "UPDATE artists 
                    SET name=?, 
                        biography=?, 
                        facebook=?,
                        instagram=?,
                        youtube=?
                WHERE artist_id = $artist->id";

        // Get connection and prepare statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $title = $data['title'] ?? $artist->name;
            $page_content = $data['page_content'] ?? $artist->biography;
            $facebook = $data['facebook'] ?? $artist->facebook;
            $instagram = $data['instagram'] ?? $artist->instagram;
            $youtube = $data['youtube'] ?? $artist->youtube;

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
    public function updateArtistImage(artist $artist, array $data)
    {
        $sql = "UPDATE artists 
                    SET [image]=?
                WHERE artist_id = $artist->id";

        // Get connection and prepare statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $query->bind_param("s", 
                $data['image']['name']
            );

            if($this->db->uploadImage($data['image']['tmp_name'], $data['image']['name'])){
                // Execute query
                $query->execute();
                $this->helper->refresh();
            } else {
                throw new Exception('Could not update the song. Please try again');
            }

        } else {
            // If connection cannot be established, throw an error
            throw new Exception('Could not update the artist image. Please try again');
        }
    }
}
?>