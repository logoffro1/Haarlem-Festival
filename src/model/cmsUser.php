<?php 
    class cmsUser {
        private int $id;
        private string $name;
        private string $email;
        private string $password;

        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }

        public function __construct(int $id, string $name, string $email, string $password) {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
        }
    }
?>