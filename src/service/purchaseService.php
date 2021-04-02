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

        public function createPurchase(string $name, string $email, array $cartItems, float $totalPrice)
        {
            $sql = "INSERT INTO Purchases (
                `name`,
                `email`,
                `price`,
                `discount`,
                `is_payed`,
            ) VALUES (?,?,?,?,?)";
    
            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("ssddi",
                    $nameParam,
                    $emailParam,
                    $totalPriceParam,
                    $discountParam,
                    false,
                );
    
                $nameParam = $name;
                $emailParam = $email;
                $totalPriceParam = $totalPrice;
                $discountParam = $discount;
                // Execute query
                $query->execute();
    
                foreach ($cartItems as $cartItem) {
                    if($cartItem instanceof performanceReservation){
                        $this->insertReservations($query->insert_id, $cartItem);
                    } else if($cartItem instanceof restaurantReservation){
                        $this->insertReservations($query->insert_id, $cartItem);
                    } else {
                        throw new Exception('cart item type not supported.');
                    }
                }
            } else {
                throw new Exception('Could not create a payment. Please try again');
            }
        }

        public function insertPerformanceReservations(int $purchaseId, $cartItem)
        {
            $sql = "INSERT INTO Reservation_Performance (
                `performance_id`,
                `purchase_id`,
                `seats`,
            ) VALUES (?,?,?)";
    
            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("iii",
                    $performanceId,
                    $purchaseIdParam,
                    $seats,
                );

                $purchaseIdParam = $purchaseId;
                $performanceId = $cartItem->performance->id;
                $seats = $cartItem->seats;
    
                // Execute query
                $query->execute();
            } else {
                throw new Exception('Could not create a reservation for performances. Please try again');
            }
        }

        public function insertCuisineReservations(int $purchaseId, $cartItem)
        {
            $sql = "INSERT INTO Reservation_Performance (
	            restaurant_id,
                purchase_id,
                seats,
                sessionNr,
                extra_info	
            ) VALUES (?,?,?,?,?)";
    
            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("iiiis",
                    $restaurantId,
                    $purchaseIdParam,
                    $seats,
                    $sessionNr,
                    $extraInfo,
                );

                $purchaseIdParam = $purchaseId;
                $restaurantId = $cartItem->restaurant->id;
                $seats = $cartItem->seats;
                $sessionNr = $cartItem->sessionNr;
                $extraInfo = $cartItem->extra_info;
    
                // Execute query
                $query->execute();
            } else {
                throw new Exception('Could not create a reservation for performances. Please try again');
            }
        }

        public function createPayment(string $email, int $orderId, float $amount, $fullname)
        {    
            $payment = $this->mollie->payments->create([
                "amount" => [
                  "currency" => "EUR",
                  "value" => "$amount"
                ],
                "description" => "Payment for the Haarlem Festival",
                "redirectUrl" => ROOT_URL_PRODUCTION."/views/thankyoupage.php?order_id=$orderId",
                "webhookUrl"  => ROOT_URL_PRODUCTION."/views/webhook.php",
                "metadata" => [
                  "order_id" => $orderId,
                  "email" => $email,
                  "fullname" => $fullname
                ]
            ]);
        
            header("Location: " . $payment->getCheckoutUrl(), true, 303);
            exit();
        }

        public function getPayment(int $id)
        {
            $payment = $this->mollie->payments->get($id);

            $isPayed = $payment->isPaid();
            $order_id = $payment->metadata->order_id;

            $data = array(
                'isPaid' => $payment->isPaid(),
                'email' => $payment->metadata->email,
                'order_id' => $payment->metadata->order_id,
                'fullname' => $payment->metadata->fullname
            );

            return $data;
        }
    }
?>