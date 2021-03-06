<?php 
class location{
    private int $id;
    private string $name;
    private string $address;
    private float $price;
    private int $seats;

    public function __construct(int $id, string $name,string $address, float $price, int $seats)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->price = $price;
        $this->seats = $seats;
    }

    public function getName(){return $this->name;}
}
?>