<?php           

class restaurantCard
{
    private string $name;
    private string $image;
    private string $address;
    private int $seats;
    private int $stars;
    private float $duration;
    private array $cuisines;
    private array $sessions;

    public function __construct(string $name, string $image, string $address, int $seats, int $stars, float $duration, array $cuisines, array $sessions)
    {
      $this->name = $name;
      $this->image = $image;
      $this->address = $address;
      $this->seats = $seats;
      $this->stars = $stars;
      $this->duration = $duration;
      $this->cuisines =  $cuisines;
      $this->sessions = $sessions;
    }

    public function render()
    {
        echo "<section class = 'card--container'>

        <h1 style='margin-bottom:0px'>$this->name</h1>
        
        <h3 style='margin-bottom:0px;margin-top:3px;'>
        <img src='../assets/images/cuisine/foodIcon.svg' class = 'card--foodicon'> ";
        $lastIndex = array_key_last($this->cuisines);
        $i = 0;
        foreach($this->cuisines as $cuisine){
            echo "$cuisine"; 
            if($i++ != $lastIndex)
                 echo " &#8226 ";
        }
        echo"
        </h3>
        <a href = '#'>
        <section class = 'card--restaurant'>
        <img src='$this->image' class = 'card--img'>
        
        <article class='right--container'>
            <img src='../assets/images/cuisine/homeIcon.svg' class = 'card--homeicon'>
        <pre class = 'card--address'>$this->address</pre>
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