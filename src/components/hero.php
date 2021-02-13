<?php
function hero(string $class, string $heading, string $text, string $image){
    return sprintf('
    <div class="hero %s" style="background-image: url(%s);">
        <div class="hero__body hero__body--background">
            <h1 class="hero__body__title--page">
                %s
            </h1>
            <p>%s</p>
        </div>
    </div>
    ', $class, $image, $heading, $text);
}
?>