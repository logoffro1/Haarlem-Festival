<?php 
class cartItem
{
    private string $title;
    private int $itemType;
    private string $address;
    private string $day;
    private string $date;
    private string $time;
    private string $additionalInfo;
    private int $count;
    private float $price;


    public function __construct(string $title, int $itemType, string $address, string $day, string $date, string $time, int $count, float $price, string $additionalInfo = null)
    {
        $this->title = $title;
        $this->itemType = $itemType;
        $this->address = $address;
        $this->day = $day;
        $this->date = $date;
        $this->time = $time;
        $this->additionalInfo = $additionalInfo;
        $this->count = $count;
        $this->price = $price;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function increaseCount(){$this->count += 1;}
    public function getTotalPrice(){return ($this->count * $this->price);}

}
?>