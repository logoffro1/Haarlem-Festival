<?php

class navigation {
    private string $activePage;

    public function __construct(string $activePage) {
        $this->activePage = $activePage;
    }

    public function render()
    {
        echo "
        <nav class='navigation'>
            <a href='../views/homepage.php'>
                <img class='navigation__brand' src='../assets/images/svg/logo.svg'/>
            </a>
            <ul class='navigation__links'>
                <li><a class='" . $this->getActivePage('Home') . "' href='../views/homepage.php'>Home</a></li>
                <li class='js-dropdown'>
                    <a class='" . $this->getActivePage('Events') . " js-dropdown__anchor' href='#'>Events</a>
                    <ul class='js-dropdown__body navigation__dropdown'>
                        <li><a href='../views/jazzEvent.php'>Jazz</a></li>
                        <li><a href='../views/danceEvent.php'>Dance</a></li>
                        <li><a href='../views/cuisineEvent.php'>Cuisine</a></li>
                        <li><a href='#'>History</a></li>
                    </ul>
                </li>
            </ul>
            <div class='navigation__shop'>
                <a class='icon icon--small icon--background icon--rounded' href='../views/cart.php'>
                    <span class='navigation__shop__item-count badge'>1</span>
                    <img src='../assets/images/svg/icons/shopping_cart-24px.svg' alt='' />
                </a>
            </div>
        </nav>
        ";
    }

    private function getActivePage(string $pageName) : string {
        return $pageName === $this->activePage ? "active" : "";
    }
}

?>