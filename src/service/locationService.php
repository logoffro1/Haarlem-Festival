<?php
    class locationService {
        private database $db;
        private mysqli $conn;

        public function __construct() {
            $this->db = database::getInstance();

            $this->conn = $this->db->getConnection();
        }

        public function getJazzLocations() : ?array
        {
            $query = "SELECT l.*
            FROM locations l
            JOIN jazz_locations jl
                ON l.location_id = jl.location_id";

            $locations = $this->getLocations($query);
        }

        public function getDanceLocations() : ?array
        {
            $query = "SELECT l.*
            FROM Locations l
            JOIN Locations_Dance dl
                ON l.location_id = dl.location_id";

            try {

                return $this->getLocations($query);
            } catch(Exception $e){
                echo $e;
            }
        }

        public function getLocations(string $query) : ?array
        {
            if ($result = $this->conn->query($query)) {
                return $this->createLocations($result);
            } else {
                // If connection could not be established throw an error
                // throw new Exception('Something went  wrong. We could not retrieve the users. Please try again.');
            }

            return null;
        }

        public function createLocations($result) : array
        {
            // Create array
            $locationsList = array();

            // fetch results, and loop over it
            while($row = $result->fetch_assoc()) {
                // Create page classes based on data
                $location = new location(
                    (int)$row["location_id"], 
                    $row["name"], 
                    $row["address"],
                    (int)$row["seats"],
                    (double)$row["price"],
                );

                // add new location to list
                $locationsList[] = $location;
            }

            // return array 
            return $locationsList;
        }
    }
?>