<?php
    class performanceService {
        private database $db;
        private mysqli $conn;
        private locationService $locationService;
        
        public function __construct() {
            $this->db = database::getInstance();
            
            $this->conn = $this->db->getConnection();
            $this->locationService = new locationService();
        }

        public function getPerformance(int $id)
        {
            $query = "SELECT * FROM Performances WHERE performance_id ='$id' LIMIT 1;";
            $result = $this->conn->query($query);

            if($result)
            {
                $performances = array();
                while($row = $result->fetch_assoc())
                {
                    return new performance(
                        $row["performance_id"],
                        $row["date"],
                        $row["time"],
                        $row["duration"],
                        (int)$row["availableTickets"],
                        $this->locationService->getLocation((int)$row["location_id"]),
                        $id
                    );
                }
                return null;
            }
        }
            
        /**
         * @param artistId - id of the selected artist
         * @return array<performance> - all performances of the artist
         */
        public function createPerformances($artistId) : array
        {       
            $performances = array();

            $query = "SELECT * FROM Performances p JOIN locations l on p.location_id = l.location_id WHERE artist_id = $artistId";

            if ($result = $this->conn->query($query)) {
                $performances = array();
                    
                // fetch results, and loop over it
                while($row = $result->fetch_assoc()) {
                    // Create page classes based on data
                    $performance = new performance(
                        (int)$row["performance_id"], 
                        $row["date"], 
                        $row["time"], 
                        (int)$row["duration"],
                        (int)$row["availableTickets"],
                        $this->locationService->createLocationFromArray($row),
                        $artistId
                    );

        
                    // add new page to list
                    $performances[] = $performance;
                }
        
                // return array 
                return $performances;
            }

            return $performances;
        }

        public function addPerformance(artist $artist, array $data) : void
        {
            $sql = "INSERT INTO Performances (location_id, artist_id, date, time, duration, availableTickets) VALUES (?,?,?,?,?,?)";

            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("iissii", 
                    $data['location'],
                    $artistId,
                    $data['date'],
                    $data['time'],
                    $data['duration'],
                    $data['tickets'],
                );

                $artistId = $artist->id;

                // Execute query
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not create a new performance. Please try again');
            }
        }

        public function deletePerformance(int $idParam)
        {
            $sql = "DELETE FROM Performances WHERE performance_id=?";

            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("i", 
                    $id
                );

                $id = $idParam;

                // Execute query
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not connect to the database. Please try again');
            }
        }

        public function updatePerformance(array $data, int $id)
        {
            $sql = "UPDATE Performances SET location_id=?, date=?, time=?, duration=?, availableTickets=? WHERE performance_id = ?";

            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("issiii", 
                    $data['location'],
                    $data['date'],
                    $data['time'],
                    $data['duration'],
                    $data['tickets'],
                    $id
                );

                // Execute query
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not update performance. Please try again');
            }
        }
    }
?>