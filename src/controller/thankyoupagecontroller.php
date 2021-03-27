<?php
    include '../classes/autoloader.php';
	@include '../service/thankyoupageservice.php';

    class thankyoupagecontroller
    {
        private thankyoupageservice $thankyoupageService;

        public function __construct() {
            $this->thankyoupageService = new thankyoupageservice();
        }

    }

?>