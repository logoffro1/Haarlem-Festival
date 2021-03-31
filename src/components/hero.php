<?php
class hero
{
    private string $class;
    private string $heading;
    private string $text;
    private string $image;
    private string $textBackground;

    public function __construct(string $class, string $heading, string $text, string $image, bool $textBackground = false) {
        $this->class = $class;
        $this->heading = $heading;
        $this->text = $text;
        $this->image = $image;
        $this->textBackground = $textBackground;
    }

    public function render()
    {
        echo sprintf("
        <section class='hero $this->class' style='background-image: url(".'"%s"'.");'>
            <article class='hero__body col-12 %s'>
                <h1 class='hero__body__title--page'>
                    $this->heading
                </h1>
                <p>
                    $this->text
                </p>
            </article>
        </section>
        ", $this->image, $this->textBackground ? 'hero__body--background' : '');
    }
}

?>