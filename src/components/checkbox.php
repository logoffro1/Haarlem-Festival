<?php
    class checkbox {
        private string $text;
        private string $name;
        private string $id;

        public function __construct(string $text, string $name, string $id) {
            $this->text = $text;
            $this->name = $name;
            $this->id = $id;
        }
        
        public function render()
        {
            echo "
            <label for='$this->id'>
                <input type='checkbox' name='$this->name' id='$this->id'>
                <span>$this->text</span>
            </label>
            ";
        }
    }

?>

