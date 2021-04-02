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

        public function createPayment(string $email, float $price, string $fullname)
        {
            try {
                $id = uniqid();
                $this->purchaseService->createPayment($email, $id, $totalPrice, $fullname);
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

                return $data;
            } catch (Exception $e){
                $this->addToErrors($e->getMessage());
            }
        }
    }
?>