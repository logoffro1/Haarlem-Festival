<?php
    include '../classes/autoloader.php';

    class dancePerformanceService extends eventService {

        public function __construct() {
            parent::__construct();
        }

        public function getEventPageContent(){

        }

        public function getAllDancePerformances()
        {
            $locationService = new locationService();

            $query = 'SELECT * FROM Performances WHERE EXISTS (SELECT * FROM Locations_Dance WHERE Performances.location_id = Locations_Dance.location_id);';
            $result = $this->conn->query($query);

            if($result)
            {
                $performances = array();
                while($row = $result->fetch_assoc())
                {
                    $performance = new dancePerformance(
                        $row["performance_id"],
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

        public function getAllDancePerformancesByArtistId(int $id)
        {
            $locationService = new locationService();

            $query = "SELECT * FROM Performances WHERE artist_id ='$id' ;";
            $result = $this->conn->query($query);

            if($result)
            {
                $performances = array();
                while($row = $result->fetch_assoc())
                {
                    $performance = new dancePerformance(
                        $row["performance_id"],
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