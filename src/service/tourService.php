<?php 
include '../classes/autoloader.php';

class tourService {

    public function __construct() {
        $this->db = database::getInstance();
        $this->conn = $this->db->getConnection();
    }

    public function getAllTours()
    {
        $query = "SELECT * FROM Tours";
        $result = $this->conn->query($query);

        if($result)
        {
            $tours = array();

            while($row = $result->fetch_assoc())
            {
                $tour = new tour(
                    $row["tour_id"],
                    $row["date"],
                    $row["time"],
                    (float)$row["price"],
                    (float)$row["family_price"],
                    (int)$row["seats_per_tour"]
                );

                $tours[] = $tour;
            }
            return $tours;
        }
    }

    public function getTourById(int $id)
    {
        $query = "SELECT * FROM Tours WHERE tour_id='$id'";
        $result = $this->conn->query($query);

        if($result)
        {
            while($row = $result->fetch_assoc())
            {
                $tour = new tour(
                    $row["tour_id"],
                    $row["date"],
                    $row["time"],
                    (float)$row["price"],
                    (float)$row["family_price"],
                    (int)$row["seats_per_tour"]
                );
                return $tour;
            }
        }
        
    }
}
?>