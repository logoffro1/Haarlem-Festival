<?php
    class countdown {
        private string $text;
        private string $url;

        public function __construct(string $title, $url) {
            $this->title = $title; //Ticket sales and in:
            $this->url = $url;
        }

        public function render()
        {
            echo "
            <section class='countdown js-countdown section section--background' end-date='2021-05-13'>
                <h3 class='countdown__title title title--tetriary'>$this->title</h3>
        
                <p class='countdown__wrapper-text'>
                    <span class='countdown__counter js-countdown__days'>00</span>
                    <span class='title title--tetriary'>Days</span>
                </p>
                <p class='countdown__wrapper-text'>
                    <span class='countdown__counter js-countdown__hours'>00</span>
                    <span class='title title--tetriary'>Hours</span>
                </p>
                <p class='countdown__wrapper-text'>
                    <span class='countdown__counter js-countdown__minutes'>00</span>
                    <span class='title title--tetriary'>Minutes</span>
                </p>
                <p class='countdown__wrapper-text'>
                    <span class='countdown__counter js-countdown__seconds'>00</span>
                    <span class='title title--tetriary'>Seconds</span>
                </p>
            </section>
            ";
        }
    }

?>