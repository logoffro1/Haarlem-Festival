<?php

if (session_status() === PHP_SESSION_NONE) 
    session_start();

 if(empty($_SESSION['cart'])) 
 {
     $cart = new cart();
     $cart->render();
     $_SESSION['cart'] = $cart;
     echo "<script>alert('New cart created.')</script>";
 }

if(!empty($_GET['performanceID']))
{
    $id = $_GET['performanceID'];

    if($_GET['type'] == 'jazz')
       $_SESSION['cart']->addItemToCart($id, "jazz");
}

class cart
{
    private $cartItems = array();
    
    public function returnCount()
    {
        $count = 0;
        foreach($this->carItems as $item)
            $count += $item->__get('count');

        return $count;
    }

    public function render()
    {
        $totalCount = $this->getCountFromCart();
        $totalCountStr = strval($totalCount);

        if ($totalCount == 0)
            echo "<script>document.getElementsByClassName('navigation__shop__item-count')[0].style.visibility = 'hidden'</script>";
        else
        {
            echo " <script>document.getElementsByClassName('navigation__shop__item-count')[0].style.visibility = 'visible'</script>
                    <script>document.getElementsByClassName('navigation__shop__item-count')[0].innerHTML = $totalCountStr</script>";
        }
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

            $jazzPerformance = $jazzPerformanceController->getAJazzPerformanceById($performanceID);
            $jazzArtist = $jazzArtistController->getAJazzArtistById($jazzPerformance->__get("artistID"));

            $title = $jazzArtist->__get('artistName');
            $type = cartItemType::Jazz;
            $address = $jazzPerformance->getLocation();
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