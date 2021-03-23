<?php
include '../classes/autoloader.php';
class danceJazzSuggestion
{
    public function render()
    {
        echo "
        <section class='container-fluid section' style='padding-top:0px; padding-bottom:0px;'>
            <h2>You may also be interested in...</h2>
            <a href='#'>
            <img src='../assets/images/dance/youmaybeinterestedin.png'></a>
        </section>";
    }
}
?>