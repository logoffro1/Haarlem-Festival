<?php 
class cartItem
{
    private int $id;
    private string $title;
    private int $itemType;
    private string $address;
    private string $day;
    private string $date;
    private string $time;
    private string $additionalInfo;
    private int $count;
    private float $price;

    //Additional info is needed for cuisine only, thus its null
    public function __construct(string $title, int $itemType, string $address, string $day, string $date, string $time, int $count, float $price, string $additionalInfo = null, int $id)
    {
        $this->id=$id;
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

    public function setCount(int $count){ $this->count = $count;}
    public function increaseCount(int $amount){$this->count += $amount;}
    public function getTotalPrice(){
        if($this->itemType == cartItemType::Cuisine)
            return number_format(($this->price),2);
        else
        return number_format(($this->count * $this->price),2);}

}
?>