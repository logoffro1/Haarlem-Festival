<?php
    class checkbox {
        private string $text;
        private string $name;
        private string $id;
        private string $value;
        private bool $checked;

        public function __construct(string $text, string $name, string $id, string $value, bool $checked = false) {
            $this->text = $text;
            $this->name = $name;
            $this->id = $id;
            $this->checked = $checked;
            $this->value = $value;
        }
        
        public function render()
        {
            echo "
            <label for='$this->id'>
                <input type='checkbox' ";if($this->checked)echo "checked"; echo " name='$this->name' id='$this->id' value = '$this->value'>
                <span>$this->text</span>
            </label>
            ";
        }
    }

?>

