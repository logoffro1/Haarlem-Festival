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

        public function createPayment(string $email, string $price, string $fullname)
        {
            try {
                $id = hexdec(uniqid());
                $this->purchaseService->createPayment($email, $id, $price, $fullname);
            } catch (Exception $e){
                // If error occured, show it in the website
                $this->addToErrors($e->getMessage());
            }
        }

        public function createReservations(string $fullname, string $email, cart $cart)
        {
            try {
                $cartItems = $cart->cartItems;
                $totalPrice = $cart->getTotalPrice();
                $discount = $cart->getDiscount();

                $purchaseId = $this->purchaseService->createPurchase($fullname, $email, $totalPrice, $discount);

                foreach ($cartItems as $cartItem) {
                    $cartItemType = $cartItem->itemType;
                    $cartItemId = $cartItem->id; // performacne id
                    $cartItemCount = $cartItem->count; // bought tickets

                    if ($cartItemType == cartItemType::Jazz || $cartItemType == cartItemType::Dance){
                        $this->purchaseService->insertPerformanceReservations($purchaseId, $cartItemId, $cartItemCount);
                    } elseif ($cartItemType == cartItemType::Cuisine) {
                        $this->purchaseService->insertCuisineReservations($purchaseId, $cartItem);
                    } else {
                        throw new Exception("Cart item type not supported");
                    }
                }
            } catch (Exception $e){
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