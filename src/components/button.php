<?php

class button
{
    private string $text;
    private string $attr;
    private string $class;

    public function __construct(string $text, string $attr, string $class)
    {
        $this->text = $text;
        $this->attr = $attr;
        $this->class = $class;
    }

    public function render($id)
    {
        echo "<button id='$id' $this->attr class='$this->class'>$this->text</button>";
    }

}

?>