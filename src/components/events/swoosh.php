<?php 

class swoosh
{
    private string $type;

    public function __construct(string $type) {
        $this->type = $type;
    }
    public function render()
    {
        echo "
        <section class='jazz--swoosh'>
        <img src='../assets/images/$this->type/$this->type-swoosh.png' class='jazz--swoosh__img'>
        </section>
        ";
    }
}

?>