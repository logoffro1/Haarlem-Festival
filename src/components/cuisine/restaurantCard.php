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

    public function __construct(string $name, string $image, string $address, int $seats, int $stars, float $duration, array $cuisine, array $sessions)
    {
        $this->name = $name;
        $this->image = $image;
        $this->address = $address;
        $this->seats = $seats;
        $this->stars = $stars;
        $this->duration = $duration;
        $this->cuisine = $cuisine;
        $this->sessions = $sessions;
    }

    public function render()
    {
        echo "
        ";
    }

}





?>