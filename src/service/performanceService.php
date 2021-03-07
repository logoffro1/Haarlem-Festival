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

            
        /**
         * @param artistId - id of the selected artist
         * @return array<performance> - all performances of the artist
         */
        public function createPerformances($artistId) : array
        {       
            $performances = array();

            $query = "SELECT * FROM performances p JOIN locations l on p.location_id = l.location_id WHERE $artistId";

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
                        $this->locationService->createLocation($row),
                    );

        
                    // add new page to list
                    $performances[] = $performance;
                }
        
                // return array 
                return $performances;
            }

            return $performances;
        }

        public function addPerformance(artist $artist, $data) : void
        {
            $sql = "INSERT INTO performances (location_id, artist_id, date, time, duration, tickets) VALUES (?,?,?,?,?,?)";

            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("iissii", 
                    $data['location'],
                    $artist->id,
                    $data['date'],
                    $data['time'],
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