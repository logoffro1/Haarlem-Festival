<?php
//Since PHP doesnt support Enumerations, this is my way of implemetation to assign a variable to cart item types
abstract class cartItemType
{
    const  Jazz = 0;
    const  Dance = 1;
    const  History = 2;
    const  Cuisine = 3;
}
?>