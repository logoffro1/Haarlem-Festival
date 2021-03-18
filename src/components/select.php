<?php
    class select
    {
        private string $name;
        private array $options;

        public function __construct(string $name, array $options) {
            $this->name = $name;
            $this->options = $options;
        }
        
        public function render()
        {
            echo "<select name='$this->name'>";

            foreach ($this->options as $option) {
                echo "<option value='".$option['value']."'>".$option["text"]."</option>";
            }

            echo "</select>";
        }
    }
    

?>