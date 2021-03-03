<?php 
    class cmsNotification {
        private string $title;
        private array $errors;
        
        public function __construct(string $title, array $errors) {
            $this->title = $title;
            $this->errors = $errors;
        }

        public function render()
        {
            echo "      
            <div class='notification--cms js-notification'>
                <h5 class='notification--cms__title'>$this->title</h5>
            ";

            foreach ($error as $this->errors) {
                echo "<p class='notification--cms__body'>$error</p>";
            }

            echo "</div>";
        }
    }
?>