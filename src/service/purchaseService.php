<?php
include_once '../config/config.php';

    class purchaseService {
        private database $db;
        private mysqli $conn;
    
        public function __construct() {
            $this->db = database::getInstance();
    
            $this->conn = $this->db->getConnection();
        }

        /**
         * getPurchaseList - Gets all the purchase details, but not the tickets related to the purchase
         * 
         * @return array<purchase> - list of all the purchases
         */
        public function getPurchaseList() : array
        {
            // Build query
            $query = "SELECT id, title FROM pages";

            // Get connection and results
            if ($result = $this->conn->query($query)) {
                // Create array
                $purchaseList = array();
                
                // fetch results, and loop over it
                while($row = $result->fetch_assoc()) {
                    // Create puchase classes based on data
                    $page = array(
                        (int)$row["id"], 
                        $row["title"], 
                    );

                    // add new page to list
                    $purchaseList[] = $page;
                }

                // return array 
                return $purchaseList;
            }

            return array();
        }
    }
?>