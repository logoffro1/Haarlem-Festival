<?php
    class controller {
        protected array $errors;
        protected array $success;

        public function __construct() {
            $this->errors = array();
            $this->success = array();
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }

        protected function addToErrors(string $error)
        {
            $this->errors[] = $error;
        }

        protected function removeErrors(){
            unset($errors);
        }

        protected function addToSuccess(string $success)
        {
            $this->success[] = $success;
        }

        protected function removeSuccess(){
            unset($success);
        }
    }
?>