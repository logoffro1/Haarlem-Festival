<?php 
    class cmsNotification {
        private string $title;
        private array $errors;
        
        public function __construct(string $title, array $errors) {
            $this->title = $title;
            $this->errors = $errors;
        }

        /**
         * @return string active css class name to show the notification
         */
        private function hasErrors() : string
        {
            if(!empty($this->errors)) {
                return ' notification--cms--is-visible';
            } else {
                return '';
            }
        }

        public function render()
        {
            echo "      
            <div class='notification--cms js-notification". $this->hasErrors() . "'>
                <h5 class='notification--cms__title'>$this->title</h5>
            ";

            foreach ($this->errors as $error) {
                echo "<p class='notification--cms__body'>$error</p>";
            }

            echo "</div>";
        }
    }
?>