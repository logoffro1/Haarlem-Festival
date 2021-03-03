<?php 
class artistService {
    private database $db;
    private mysqli $conn;

    public function __construct() {
        $this->db = database::getInstance();

        $this->conn = $this->db->getConnection();
    }

    public function getJazzArtists() : array
    {
        $this->getArtistList(1); // Todo change id to correct jazz page id in database
    }

    public function getDanceArtists() : array
    {
        $this->getArtistList(2); // Todo change id to correct jazz page id in database
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
     * @param artistId - id of an artist
     * @return artist - specific details of the artist
     */
    public function getArtist(int $artistId)
    {
        
    }
}
?>