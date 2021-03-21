<?php
    include '../classes/autoloader.php';
	include '../models/location.php';

    class locationService {

    public function __construct()
    {
        $this->db = database::getInstance();
        $this->conn = $this->db->getConnection();
    }

    public function getLocationByID(int $id)
    {
        $query = "SELECT * FROM Locations WHERE location_id = '$id'";
        $result = $this->conn->query($query);

        if($result)
        {
            while($row = $result->fetch_assoc())
                {
                    $location = new location(
                        $row["location_id"],
                        $row["name"],
                        $row["address"],
                        $row["price"],
                        $row["seats"]
                    );
                }
         return $location;
        }
    }
}
?>