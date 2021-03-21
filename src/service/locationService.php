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
            FROM Locations l
            JOIN Locations_Jazz jl
                ON l.location_id = jl.location_id";

            try {
                return $this->getLocations($query);
            } catch(Exception $e){
                throw new Exception("Could not retrieve the performance locations");
            }
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
                throw new Exception("Could not retrieve the performance locations");
            }
        }

        public function getLocations(string $query) : ?array
        {
            if ($result = $this->conn->query($query)) {
                return $this->createLocations($result);
            } else {
                throw new Exception('Something went  wrong. We could not retrieve the users. Please try again.');
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

        public function getLocation(int $location_id) : location
        {
            $query = "SELECT * FROM locations where location_id = $location_id";

            if ($result = $this->conn->query($query)) {
                
                $objectResult = $result->fetch_object();
                
                return $this->createLocation($objectResult);
            }
        }

        public function createLocation($result) : location
        {
            return new location(
                (int)$result->location_id,
                $result->name,
                $result->address,
                $result->seats,
                $result->price
            );
        }

        public function createLocationFromArray($result) : location
        {
            return new location(
                (int)$result['location_id'],
                $result['name'],
                $result['address'],
                $result['seats'],
                $result['price']
            );
        }
    
    }
?>