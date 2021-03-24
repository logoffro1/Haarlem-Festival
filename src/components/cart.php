<?php

 session_start();
 if(!$_SESSION['cart'])
 {
     $cart = new cart();
     $cart->render();
     $_SESSION['cart'] = $cart;
     echo "<script>alert('New cart created.')</script>";
 }
 else
 {

}
if(!empty($_GET['performanceID']))
{
    $id = $_GET['performanceID'];
    echo "<script>alert($id);</script>";
    $_SESSION['cart']->addItemToCart();
}

class cart
{
    private $jazzPerformances = array();
    private $dancePerformances = array();
    private $historyPerformances = array();
    private $cuisinePerformances = array();


    public function returnCount()
    {
        return (count($this->jazzPerformances) + count($this->dancePerformances) + count($this->historyPerformances) + count($this->cuisinePerformances));
    }

    public function render()
    {
        $totalCount = count($this->jazzPerformances) + count($this->dancePerformances) + count($this->historyPerformances) + count($this->cuisinePerformances);
        $totalCountStr = strval($totalCount);

        if ($totalCount == 0)
            echo "<script>document.getElementsByClassName('navigation__shop__item-count')[0].style.visibility = 'hidden'</script>";
        else
        {
            echo " <script>document.getElementsByClassName('navigation__shop__item-count')[0].style.visibility = 'visible'</script>
                    <script>document.getElementsByClassName('navigation__shop__item-count')[0].innerHTML = $totalCountStr</script>";
        }
    }

    public function addItemToCart()
    {
        $this -> jazzPerformances[] = array("test" => "test");
    }
}
?>