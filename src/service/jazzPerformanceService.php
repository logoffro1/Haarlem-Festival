<?php 
    include '../classes/autoloader.php';

    class jazzPerformanceService extends eventService {

        public function __construct() {
            parent::__construct();
        }

        public function getEventPageContent(){
            
        }

        public function getAllJazzPerformances()
        {
            $jazzArtistService = new jazzArtistService();
            $locationService = new locationService();

            $query = 'SELECT * FROM Performances WHERE EXISTS (SELECT * FROM Locations_Jazz WHERE Performances.location_id = Locations_Jazz.location_id);';
            $result = $this->conn->query($query);

            if($result)
            {
                $performances = array();
                while($row = $result->fetch_assoc())
                {
                    $performance = new jazzPerformance(
                        $row["performance_id"],
                        $jazzArtistService->getAnArtistById((int)$row["artist_id"]),
                        $locationService->getLocationByID((int)$row["location_id"]),
                        $row["date"],
                        $row["time"],
                        $row["duration"],
                        $row["availableTickets"]
                    );
                    
                    $performances[]=$performance;
                }
                return $performances;
            }
        }

        public function getAllJazzPerformancesByArtistId(int $id)
        {
            $query = "SELECT * FROM Performances WHERE artist_id ='$id' ;";
            $result = $this->conn->query($query);

            if($result)
            {
                $performances = array();
                while($row = $result->fetch_assoc())
                {
                    $performance = new jazzPerformance(
                        $row["performance_id"],
                        $jazzArtistService->getAnArtistById((int)$row["artist_id"]),
                        $locationService->getLocationByID((int)$row["location_id"]),
                        $row["date"],
                        $row["time"],
                        $row["duration"],
                        $row["availableTickets"]
                    );
                    
                    $performances[]=$performance;
                }
                return $performances;
            }
        }
    }
    
?>