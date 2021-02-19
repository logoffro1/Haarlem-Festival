<?php
    class table
    {
        private string $class;
        private array $tableHeader;
        private array $tableBody;

        public function __construct(string $class, array $tableHeader, array $tableBody) {
            $this->class = $class;
            $this->tableHeader = $tableHeader;
            $this->tableBody = $tableBody;
        }

        public function render()
        {
            echo "<table class='table $this->class'>";
                echo "<thead>";
                    echo "<tr>";
                    foreach ($this->tableHeader as $item) {
                        echo "<th>$item</th>";
                    }
                    echo "</tr>";
                echo "</thead>";

                echo "<tbody>";
                foreach ($this->tableBody as $item) {
                    echo "<tr>";
                    foreach ($item as $value) {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody>";
            echo "</table>";
        }
    }
    
?>