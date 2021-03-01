<?php 
    class cmsUser {
        private int $id;
        private string $username;
        private string $password;

        public function __construct(int $id, string $username, string $password) {
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
        }
    }
?>