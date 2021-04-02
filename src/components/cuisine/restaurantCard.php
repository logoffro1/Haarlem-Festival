<?php           

class restaurantCard
{
    private int $restaurantId;
    private string $name;
    private string $image;
    private string $street;
    private string $zipCode;
    private int $seats;
    private int $stars;
    private float $duration;
    private array $cuisines;
    private array $sessions;

    public function __construct(int $restaurantId,string $name, string $image, string $address, int $seats, int $stars, float $duration, array $cuisines, array $sessions)
    {
      $this->name = $name ?? '';
      $this->image = $image ?? '';
      $this->street = $this->getStreet($address) ?? '';
      $this->zipCode = $this->getZipCode($address) ?? '';
      $this->seats = $seats ?? 0;
      $this->stars = $stars ?? 0;
      $this->duration = $duration ?? 0;
      $this->cuisines =  $cuisines ?? array();
      $this->sessions = $sessions ?? 0;
      $this->restaurantId = $restaurantId;
    }

    private function getStreet(string $address)
    {
        if(strlen($address) > 0) { 
            return explode(",",$address)[0].",";
        }

        return '';
    }

    private function getZipCode(string $address){
        if(strlen($address) > 0) { 
            return explode(",",$address)[1] ?? '';
        }

        return '';
    }

    public function render()
    {
        echo "
        <section class = 'card--container col-5'>

        <h1 style='margin-bottom:0px'>$this->name</h1>
        <h3 style='margin-bottom:0px;margin-top:3px;'>
        <img src='../assets/images/cuisine/foodIcon.svg' class = 'card--foodicon'> ";
        $lastIndex = array_key_last($this->cuisines);
        $i = 0;
        foreach($this->cuisines as $cuisine){
            if($cuisine->__get('name') == "All") continue;
            echo $cuisine->__get('name'); 
            if($i++ != $lastIndex-1)
                 echo " &#8226 ";
        }
        $id = $this->restaurantId;
        echo"
        </h3>
        <a href = 'restaurantPage.php?id=$id'>
        <section class = 'card--restaurant'>
        <img src='$this->image' class = 'card--img'>
        
        <article class='right--container'>
            <img src='../assets/images/cuisine/homeIcon.svg' class = 'card--homeicon'>
            <fieldset class = 'card--address'>
        <p>$this->street</p>
        <p>$this->zipCode</p>
        </fieldset>
        <pre class = 'card--sessions'><span style='font-weight: 900;letter-spacing: 3px;'>Sessions</span>";
        $lastIndex = array_key_last($this->sessions);
        $i = 0;
        foreach($this->sessions as $session){
            echo"\n$session";
            if($i++ != $lastIndex)
            echo"\n          &#8226";
        }
        echo "</pre>
        <fieldset class = 'card--stars'>";
        for($x = 0; $x < 5; $x++){
            if($x<$this->stars){
                echo "<img src='../assets/images/cuisine/starFilled.png'>";
                continue;
            }
            echo "<img src='../assets/images/cuisine/starEmpty.png'>";
        }
       echo "
        </fieldset>
        <fieldset class = 'card--duration'>
            $this->duration h
            <img src='../assets/images/cuisine/clockIcon.png'>
        </fieldset>
        <fieldset class = 'card--seats'>
            $this->seats
            <img src='../assets/images/svg/icons/people-24px.svg'>
        </fieldset>
        <img src='../assets/images/cuisine/arrowIcon.png' class = 'card--arrow'>
        <img src='../assets/images/cuisine/orangeSwoosh.png' class = 'card--swoosh'>
        </article>
        
        
        </section>
        </a>
        </section>
        ";
    }

}





?>