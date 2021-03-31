<?php 
    include '../classes/autoloader.php';

    class editPagesService {
        private database $db;
        private mysqli $conn;

        public function __construct() {
            $this->db = database::getInstance();

            $this->conn = $this->db->getConnection();
        }

        /*
        * getPagesList - get the title and id of the 'global' pages (home, events), that can be changed in the database
        * @return array || null - array of pages or null
        */
        public function getPagesList() : ?array
        {
            // Build query
            $query = "SELECT id, title FROM Pages";

            // Get connection and results
            // If there are results create a list of users, otherwise return null
            if ($result = $this->conn->query($query)) {
                return $this->createPagesList($result);
            }

            return array();
        }

        public function getPageDetails(int $pageId)
        {
            // Build query
            $query = "SELECT * FROM Pages WHERE id = ?";


            if($stmt =  $this->conn->prepare($query)) {
                // Create bind params to prevent sql injection
                $stmt->bind_param("i", $pageId);
                
                // Execute statement
                $stmt->execute();

                // Get the result
                $result = $stmt->get_result();
           
                // Create a array of users with the results
                return $this->createPage($result);
            } else {
                // If connection could not be established throw an error
                throw new Exception('Something went  wrong. We could not retrieve the users. Please try again.');
            }

            return null;
        }

        private function createPagesList($result) : array
        {
            // Create array
            $pagesList = array();
            
            // fetch results, and loop over it
            while($row = $result->fetch_assoc()) {
                // Create page classes based on data
                $page = array(
                    (int)$row["id"], 
                    $row["title"], 
                );

                // add new page to list
                $pagesList[] = $page;
            }

            // return array 
            return $pagesList;
        }
    }
    
?>