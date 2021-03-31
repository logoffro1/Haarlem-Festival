<?php
include '../classes/autoloader.php';
class exploreMap
{
    private string $type;
    
    public function __construct(string $type) {
        $this->type = $type;
    }
    function render()
    {
        //create explore haarlem map
        echo "
        <section class='container section exploreHaarlem exploreHaarlem--$this->type'>
            <h2 style='margin-right:250px;'>Arrive Early, Enjoy More!</h2>
            <img src='../assets/images/$this->type/exploreHaarlem/Map.png'>
        </section>
        ";
    }
}
?>