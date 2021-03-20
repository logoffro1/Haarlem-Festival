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
            $query = "SELECT * FROM purchases";

            // Get connection and results
            if ($result = $this->conn->query($query)) {
                // Create array
                $purchaseList = array();
                
                // fetch results, and loop over it
                while($row = $result->fetch_assoc()) {
                    // Create puchase classes based on data
                    $purchase = new purchase (
                        (int)$row["purchase_id"], 
                        $row["name"], 
                        $row["email"], 
                        (float)$row["price"], 
                        (float)$row["discount"], 
                        $row["is_payed"] == 1, 
                    );

                    // add new purchase to list
                    $purchaseList[] = $purchase;
                }

                // return array 
                return $purchaseList;
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not get the purchases. Please try again');
            }

            return array();
        }

        /**
         * changePurchasePaymentStatus - Updates the payment status of a specific purchase (by id), to true or false
         * 
         * @param bool $isPayed - boolean to check if payment is set to True or False.
         * @param int $purchaseId - id of the selected purchase.
         */
        public function changePurchasePaymentStatus(int $isPayed, int $purchaseId)
        {
            // Build query
            $sql = "UPDATE purchases SET is_payed=? WHERE purchase_id=?";

            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("ii", 
                    $isPayed, // In Mysql the boolean is actually converted to a 'Tinyint' that is restricted to values: 0 / 1, so we need to bind it as an Int.
                    $purchaseId
                );
                
                // Execute query
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not update the payment status. Please try again');
            }
        }
    }
?>