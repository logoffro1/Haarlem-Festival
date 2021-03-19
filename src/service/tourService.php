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
                    (int)$row["seats_per_tour"],
                    $this->getTourTypes($row["tour_id"])
                );

                return $tour;
            }
        }
    }

    public function addTour(array $data)
    {
        // Build query
        $sql = "INSERT INTO tours (page_id, date, time, price, family_price, seats_per_tour) VALUES (?,?,?,?,?,?)";

        // Get connection and preapre statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $query->bind_param(
                "issddi",
                $data['page_id'],
                $data['date'],
                $data['time'],
                $data['price'],
                $data['family_price'],
                $data['seats'],
            );

            // Execute query
            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception("Cannot add a new tour. please try again.");
        }
    }

    public function updateTour(array $data, tour $tour)
    {
        // Build query
        $sql = "UPDATE tours 
                    SET date=?,
                        time=?,
                        price=?,
                        family_price=?,
                        seats_per_tour=?
                WHERE tour_id=?";

        // preapre statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $query->bind_param(
                "ssddii",
                $data['date'],
                $data['time'],
                $data['price'],
                $data['family_price'],
                $data['seats'],
                $tourId
            );
            
            $tourId = $tour->id;

            // Execute query
            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception("Cannot add a new tour. please try again.");
        }
    }

    /**
     * getTourTypes - Amount of tours and the language of a specific tour
     * 
     * @param int $id - id of the specific tour
     * @return array<tourTypes> - array of amount and language of the tours
     */
    public function getTourTypes(int $id) : array
    {
        $query = "SELECT * FROM Tour_Types WHERE tour_id=?";

        if($stmt =  $this->conn->prepare($query)) {
            // Create bind params to prevent sql injection
            $stmt->bind_param("i", $id);

            // Execute query
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            $tourTypesArray = array();
            while($row = $result->fetch_assoc())
            {
                $tourType = new tourType(
                    (int)$row["tour_id"],
                    (int)$row["tour_types_id"],
                    (int)$row["tour_guide_id"],
                    $row["amount_of_tours"],
                    $row["language"]
                );

                $tourTypesArray[] = $tourType;
            }

            return $tourTypesArray;
        }
    }

    public function addTourType(array $data, tour $tour) : void
    {
        // Build query
        $sql = "INSERT INTO tour_types (tour_id, tour_guide_id, amount_of_tours, `language`) VALUES (?,?,?,?)";

        // preapre statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $tourGuideId = 1;

            $query->bind_param(
                "iiis",
                $tourId,
                $tourGuideId,
                $data['number_of_tours'],
                $data['language']
            );

            $tourId = $tour->id;

            // Execute query
            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception("Cannot add a new tour. please try again.");
        }
    }

    public function updateTourType(array $data) : void
    {
        // If seats is 0 delete the row. Else update it
        if($data['number_of_tours'] == 0){
            $this->deleteTourType($data);
            return;
        }

        // Build query
        $sql = "UPDATE tour_types 
                    SET amount_of_tours=?
                WHERE tour_types_id=?";

        // preapre statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $query->bind_param(
                "ii",
                $data['number_of_tours'],
                $data['tourTypeId']
            );
            
            // Execute query
            var_dump($data);
            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception("Cannot add a new tour. please try again.");
        }
    }

    public function deleteTourType(array $data)
    {
        $sql = "DELETE FROM tour_types WHERE tour_types_id=?";

        // preapre statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $query->bind_param(
                "i",
                $data['tourTypeId']
            );
            
            // Execute query
            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception("Cannot delete the tour type. please try again.");
        }
    }
}
?>