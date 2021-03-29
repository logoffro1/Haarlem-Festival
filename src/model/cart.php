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

    public function addItemToCart(int $performanceID, string $type)
    {
        if($type == "jazz")
        {
            $jazzPerformanceController = new jazzPerformanceController();
            $jazzArtistController = new jazzArtistController();
            
            //cart item needs both artist name and performance info, thus i get both objects
            $jazzPerformance = $jazzPerformanceController->getAJazzPerformanceById($performanceID);
            $jazzArtist = $jazzArtistController->getAJazzArtistById($jazzPerformance->__get("artistID"));

            $title = $jazzArtist->__get('artistName');
            $type = cartItemType::Jazz;
            $address = $jazzPerformance->getLocation();

            foreach($this->cartItems as $cartItem)
            {
                //If the same performance on  the same day from the same artist has already been added to the cart, it increases count instead of adding a new object
                if($title == $cartItem->__get('title') && $type == $cartItem->__get('itemType') && $address == $cartItem->__get('address'))
                {
                    $cartItem->increaseCount();
                    return;
                }
            }
            $day = $jazzPerformance->getDayOfWeek();
            $date = $jazzPerformance->getDate();
            $time = $jazzPerformance->getTime();
            $count = 1;
            $price = $jazzPerformance->getPrice();
    
            $cartItem = new cartItem($title, $type, $address, $day, $date, $time, $count, $price, "");
            $this->cartItems[] = $cartItem;
        }
    }
}
?>