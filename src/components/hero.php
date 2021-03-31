<?php
class hero
{
    private string $class;
    private string $heading;
    private string $text;
    private string $image;

    public function __construct(string $class, string $heading, string $text, string $image) {
        $this->class = $class;
        $this->heading = $heading;
        $this->text = $text;
        $this->image = $image;
    }

    public function render()
    {
        echo sprintf("
        <div class='hero $this->class' style='background-image: url(".'"%s"'.");'>
            <div class='hero__body hero__body--background'>
                <h1 class='hero__body__title--page'>
                    $this->heading
                </h1>
                <p>
                    $this->text
                </p>
            </div>
        </div>
        ", $this->image);
    }
}

?>