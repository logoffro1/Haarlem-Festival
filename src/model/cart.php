<?php
class cart
{
    private $cartItems;

    public function __construct()
    {
        $this->cartItems = array();
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function setCartItems(array $cartItems)
    {
        $this->cartItems = $cartItems;
    }

    public function render()
    {
        $totalCount = $this->getCountFromCart();
        $totalCountStr = strval($totalCount);
        //Cart visual has been rendered according to the cart item count, since it is a part of the navigation I use javascript to edit the component
        if ($totalCount == 0)
            echo "<script>document.getElementsByClassName('navigation__shop__item-count')[0].style.visibility = 'hidden'</script>";
        else
        {
            echo " <script>document.getElementsByClassName('navigation__shop__item-count')[0].style.visibility = 'visible'</script>
                    <script>document.getElementsByClassName('navigation__shop__item-count')[0].innerHTML = $totalCountStr</script>";
        }
    }

    public function removeAnItemByIndex(int $index)
    {
        unset($this->cartItems[$index]);
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;
        foreach($this->cartItems as $item)
            $totalPrice += ($item->__get('count') * $item->__get('price'));

        return number_format($totalPrice,2);
    }

    public function getDiscount()
    {
        //If there is only 1 item, there is no discount. I check it here
        if($this->getCountFromCart() > 1)
            return number_format($this->getTotalPrice() / 10, 2);
        else
            return 0;
    }

    public function getPriceAfterDiscount()
    {
        return number_format($this->getTotalPrice() - $this->getDiscount(), 2);
    }
    public function getCountFromCart()
    {
        $count = 0;
        foreach($this->cartItems as $item)
            $count += $item->__get('count');
        return $count;
    }

    public function addItemToCart(int $performanceID, int $artistID, string $eventType)
    {
        if($eventType == "jazz" || $eventType =="dance")
        {
            $performanceController = new performanceController();
            $artistController = new artistController();
            
            //cart item needs both artist name and performance info, thus i get both objects
            $performance = $performanceController->getPerformance($performanceID);
            $artist = $artistController->getArtistById($artistID);

            $title = $artist->__get('name');
            if($eventType == "jazz")
                $type = cartItemType::Jazz;
            else if($eventType == "dance")
                $type = cartItemType::Dance;
            
            $address = $performance->getLocation();

            foreach($this->cartItems as $cartItem)
            {
                //If the same performance on  the same day from the same artist has already been added to the cart, it increases count instead of adding a new object
                if($title == $cartItem->__get('title') && $type == $cartItem->__get('itemType') && $address == $cartItem->__get('address'))
                {
                    $cartItem->increaseCount();
                    return;
                }
            }
            $day = $performance->getDayOfWeek();
            $date = $performance->getDate();
            $time = $performance->getTime();
            $count = 1;
            $price = $performance->getPrice();
    
            $cartItem = new cartItem($title, $type, $address, $day, $date, $time, $count, $price, "");
            $this->cartItems[] = $cartItem;
        }
    }
}
?>