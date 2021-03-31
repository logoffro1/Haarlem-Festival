<?php
    include '../classes/autoloader.php';

    class purchaseController extends controller {
        private purchaseService $purchaseService;

        public function __construct() {
            parent::__construct();
            $this->purchaseService = new purchaseService();
        }

        public function getPurchaseList() : ?array
        {
            try {
                return $this->purchaseService->getPurchaseList();
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        public function changePurchasePaymentStatus() : void
        {
            try {
                $isPayed = isset($_POST['isPayed']);
                $id = $_POST['purchaseId'];
    
                $this->purchaseService->changePurchasePaymentStatus($isPayed, $id);
                $this->helper->refresh();
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        public function createPayment(string $email, array $cartItems)
        {
            try {
                $name = isset($_POST['name']);
                $email = isset($_POST['email']);
                $totalPrice = $this->getTotalPrice($cartItems);

                $id = $this->purchaseService->createPurchase($name, $email, $cartItems, $totalPrice);
    
                $this->purchaseService->createPayment($email, $id, $totalPrice);
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        public function getTotalPrice($cartItems) : float
        {
            try {
                $totalPrice = 0;

                foreach ($cartItems as $cartItem) {
                    if($cartItem instanceof performanceReservation){
                        $totalPrice += $cartItem->location->price;
                    } else if($cartItem instanceof restaurantReservation){
                        $totalPrice += $cartItem->price;
                    } else {
                        throw new Exception("Something went wrong calculating the total price");
                    }
                }

                return $totalPrice;
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }

        public function getPayment()
        {
            try {
                $id = $_POST['id'];
                $data = $this->purchaseService->getPayment($id);

                if($data['id'] == 0){
                    throw new Exception("Payment error. Payment not found");
                }

                if($data['isPayed']){
                    $this->purchaseService->changePurchasePaymentStatus(true, $id);
                }
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }
    }
?>