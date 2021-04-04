<?php
include_once '../config/config.php';
include '../classes/autoloader.php';
require_once __DIR__ . "/../vendor/autoload.php";
use Mollie\Api\MollieApiClient;

    class purchaseService {
        private database $db;
        private mysqli $conn;
        private MollieApiClient $mollie;

        public function __construct() {
            $this->db = database::getInstance();
    
            $this->conn = $this->db->getConnection();
            
            $this->mollie = new MollieApiClient();
            $this->mollie->setApiKey(MOLLIE_API);
        }

        /**
         * getPurchaseList - Gets all the purchase details, but not the tickets related to the purchase
         * 
         * @return array<purchase> - list of all the purchases
         */
        public function getPurchaseList() : array
        {
            // Build query
            $query = "SELECT * FROM Purchases";

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
                        $row["is_payed"] == 1, // Mysql uses 0 and 1 for true and false, so we check if 'is_payed' is equal to 1, which will return true or false
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
         * getPurchase - Gets on purchase details, but not the tickets related to the purchase
         * 
         * @return purchase - specific purchase based on id
         */
        public function getPurchase(int $id) : ?purchase
        {
            // Build query
            $query = "SELECT * FROM Purchases WHERE purchase_id = ? LIMIT 1";

            // Get connection and results
            if ($stmt = $this->conn->prepare($query)) {
                
                // Create bind params to prevent sql injection
                $stmt->bind_param("i", $id);

                // Execute query
                $stmt->execute();

                $result = $stmt->get_result();

                if($result->num_rows == 0){
                    return null;
                }

                // Get the result
                $objectResult = $result->fetch_object();
                
                $purchase = new purchase (
                    (int)$objectResult->purchase_id, 
                    $objectResult->name, 
                    $objectResult->email, 
                    (float)$objectResult->price, 
                    (float)$objectResult->discount, 
                    $objectResult->is_payed == 1, // Mysql uses 0 and 1 for true and false, so we check if 'is_payed' is equal to 1, which will return true or false
                );

                return $purchase;
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not get the purchases. Please try again');
            }
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
            $sql = "UPDATE Purchases SET is_payed=? WHERE purchase_id=?";

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

        public function createPurchase(string $name, string $email, float $totalPrice, float $discount)
        {
            $sql = "INSERT INTO Purchases (
                `name`,
                `email`,
                `price`,
                `discount`,
                `is_payed`
            ) VALUES (?,?,?,?,?)";
    
            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("ssddi",
                    $nameParam,
                    $emailParam,
                    $totalPriceParam,
                    $discountParam,
                    $isPayedParam,
                );
    
                $nameParam = $name;
                $emailParam = $email;
                $totalPriceParam = $totalPrice;
                $discountParam = $discount;
                $isPayedParam = false;

                // Execute query
                $query->execute();
    
                return $query->insert_id;
            } else {
                throw new Exception('Could not create a payment. Please try again');
            }
        }

        public function insertPerformanceReservations(int $purchaseId, $performanceId, $seats)
        {
            $sql = "INSERT INTO Reservation_Performance (
                `performance_id`,
                `purchase_id`,
                `seats`
            ) VALUES (?,?,?)";
    
            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("iii",
                    $performanceIdParam,
                    $purchaseIdParam,
                    $seatsParam,
                );

                $purchaseIdParam = $purchaseId;
                $performanceIdParam = $performanceId;
                $seatsParam = $seats;
    
                // Execute query
                $query->execute();
            } else {
                throw new Exception('Could not create a reservation for performances. Please try again');
            }
        }

        public function insertCuisineReservations(int $purchaseId, $cartItem)
        {
            $sql = "INSERT INTO Reservation_Cuisine (
	            restaurant_id,
                purchase_id,
                seats,
                `time`,
                extra_info	
            ) VALUES (?,?,?,?,?)";
    
            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("iiiss",
                    $restaurantId,
                    $purchaseIdParam,
                    $seats,
                    $time,
                    $extraInfo,
                );

                $purchaseIdParam = $purchaseId;
                $restaurantId = $cartItem->id;
                $seats = $cartItem->count;
                $time = $cartItem->time;
                $extraInfo = $cartItem->additionalInfo;
    
                // Execute query
                $query->execute();
            } else {
                throw new Exception('Could not create a reservation for performances. Please try again');
            }
        }

        public function createPayment(string $email, string $amount, string $fullname, int $orderId)
        {    
            $protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
            $hostname = $_SERVER['HTTP_HOST'];
            $path = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);
            
            $payment = $this->mollie->payments->create([
                "amount" => [
                  "currency" => "EUR",
                  "value" => $amount
                ],
                "description" => "Payment for the Haarlem Festival",
                "redirectUrl" => "{$protocol}://{$hostname}{$path}/thankyoupage.php?order_id=$orderId",
                "webhookUrl"  => "{$protocol}://{$hostname}{$path}/webhook.php", // Add $path back, bcs it has value /views
                "metadata" => [
                  "order_id" => $orderId,
                  "email" => $email,
                  "fullname" => $fullname,
                ]
            ]);
        
            header("Location: " . $payment->getCheckoutUrl(), true, 303);
            exit();
        }

        public function getPayment($id)
        {
            $payment = $this->mollie->payments->get($id);

            $isPayed = $payment->isPaid();
            $order_id = $payment->metadata->order_id;

            $data = array(
                'isPaid' => $payment->isPaid(),
                'email' => $payment->metadata->email,
                'order_id' => $payment->metadata->order_id,
                'fullname' => $payment->metadata->fullname,
                'cart' => $payment->metadata->cart
            );

            return $data;
        }

        public function deletePurchase(int $purchaseId)
        {
            $sql = "DELETE FROM Purchases WHERE purchase_id=?";
    
            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("i", 
                    $id
                );
    
                $id = $purchaseId;
    
                // Execute query
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not delete the purchase from the database. Please try again');
            }
        }
    }
?>