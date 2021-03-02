<?php           

class restaurantCard
{
    private string $name;
    private string $image;
    private string $address;
    private int $seats;
    private int $stars;
    private float $duration;
    private array $cuisine;
    private array $sessions;

    public function __construct()
    {
      
    }

    public function render()
    {
        echo "<section class = 'card--container'>

        <h1 style='margin-bottom:0px'>Restaurant Mr. & Mrs.</h1>
        
        <h3 style='margin-bottom:0px;margin-top:3px;'>
        <img src='../assets/images/cuisine/foodIcon.svg' class = 'card--foodicon'>
        Dutch &#8226 European &#8226 Fish and Seafood</h3>
        <a href = '#'>
        <section class = 'card--restaurant'>
        <img src='../assets/images/cuisine/ratatouille.jpg' class = 'card--img'>
        
        <article class='right--container'>
            <img src='../assets/images/cuisine/homeIcon.svg' class = 'card--homeicon'>
        <pre class = 'card--address'>Lange Veerstraat 4,
2011 DB Haarlem</pre>
        <pre class = 'card--sessions'><span style='font-weight: 900;letter-spacing: 3px;'>Sessions</span>
18:00-19:30
          &#8226
19:30-21:00
          &#8226
21:00-22:30
        </pre>
        <fieldset class = 'card--stars'>
        <img src='../assets/images/cuisine/starFilled.png'>
        <img src='../assets/images/cuisine/starFilled.png'>
        <img src='../assets/images/cuisine/starFilled.png'>
        <img src='../assets/images/cuisine/starFilled.png'>
        <img src='../assets/images/cuisine/starEmpty.png'>
        </fieldset>
        <fieldset class = 'card--duration'>
            1.5 h
            <img src='../assets/images/cuisine/clockIcon.png'>
        </fieldset>
        <fieldset class = 'card--seats'>
            40
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