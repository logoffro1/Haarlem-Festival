<?php
    class ticketList
    {
        private array $tickets;

        public function __construct(array $tickets) {
            $this->tickets = $tickets;
        }

        public function render()
        {
            echo "
                <section class='container ticket-list'>
                    <ul class='ticket-list__header'>
                        <li>When</li>
                        <li>Where</li>
                        <li>Price</li>
                    </ul>
                    <ul class='ticket-list__body'>
                        <li class='ticket ticket--jazz'>
                            <ul class='ticket-list__ticket__info'>
                                <li>Saturday, 28 July | 21.00 - 22.00</li>
                                <li>Main Hall - Patronaat</li>
                                <li>€15,00</li>
                                <li><a href='#' class='button'>Get your tickets</a></li>
                            </ul>
                        </li>
                        <li class='ticket ticket--dance'>
                            <ul class='ticket-list__ticket__info'>
                                <li>Saturday, 28 July | 21.00 - 22.00</li>
                                <li>Main Hall - Patronaat</li>
                                <li>€15,00</li>
                                <li><a href='#' class='button'>Get your tickets</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
            ";
        }
    }  
?>

