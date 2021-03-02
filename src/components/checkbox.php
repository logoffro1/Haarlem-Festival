<?php
    class checkbox {
        private string $text;
        private string $name;
        private string $id;
        private string $class;

        public function __construct(string $text, string $name, string $id, string $class = "") {
            $this->text = $text;
            $this->name = $name;
            $this->id = $id;
            $this->class = $class;
        }
        
        public function render()
        {
            echo "
            <label for='$this->id' class ='$this->class'>
                <input type='checkbox' name='$this->name' id='$this->id' >
                <span >$this->text</span>
            </label>
            ";
        }
    }

?>

