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
            <a href='#'>
                <img class='navigation__brand' src='/assets/images/svg/logo.svg'/>
            </a>
            <ul class='navigation__links'>
                <li><a class=" . $this->getActivePage('Home') . " href='#'>Home</a></li>
                <li><a class=" . $this->getActivePage('Events') . " href='#'>Events</a></li>
                <li><a class=" . $this->getActivePage('Your Programme') . " href='#'>Your Programme</a></li>
            </ul>
            <div class='navigation__shop'>
                <a class='icon icon--small icon--background icon--rounded' href='#'>
                    <span class='navigation__shop__item-count badge'>1</span>
                    <img src='/assets/images/svg/icons/shopping_cart-24px.svg' alt='' />
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