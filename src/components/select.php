<?php
    class select
    {
        private string $text;
        private string $name;
        private array $options;

        public function __construct(string $text, $name, array $options) {
            $this->text = $text;
            $this->name = $name;
            $this->options = $options;
        }
        
        public function render()
        {
            echo "<select name='$this->name'>";

            foreach ($options as $option) {
                echo "<option value='$option->value'>$option->text</option>";
            }

            echo "</select>";
        }
    }
    

?>