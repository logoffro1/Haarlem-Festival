<?php

class hero
{
    private string $type;
    private string $heading;
    private string $text;
    private string $image;

    public function __construct(string $type, string $heading, string $text, string $image) {
        $this->type = $type;
        $this->heading = $heading;
        $this->text = $text;
        $this->image = $image;
    }

    public function render()
    {
        echo "
        <div class='hero $this->type' style='background-image: url($this->image);'>
            <div class='hero__body hero__body--background'>
                <h1 class='hero__body__title--page'>
                    $this->heading
                </h1>
                <p>
                    $this->text
                </p>
            </div>
        </div>
        ";
    }
}

?>