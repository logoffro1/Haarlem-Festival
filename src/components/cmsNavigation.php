<?php 

class cmsNavigation {
    private string $activePage;

    public function __construct(string $activePage) {
        $this->activePage = $activePage;
    }

    public function render()
    {
        echo "
        <aside class='navigation--cms'>
            <header class='navigation--cms__header'>
                <img src='./assets/images/svg/logo.svg' alt=''>
                <a href='#' class='navigation--cms__header__profile'>
                    <img src='' alt=''>
                </a>
            </header>
            <nav class='navigation--cms__body'>
                <ul>
                    <li><a href='#' class='button button--cms" . $this->getActivePage("Edit") . "''>Edit Pages</a></li>
                    <li><a href='#' class='button button--cms" . $this->getActivePage("Events") . "'>Events</a></li>
                    <li><a href='#' class='button button--cms" . $this->getActivePage("Reservations") . "'>Reservations</a></li>
                    <li><a href='#' class='button button--cms" . $this->getActivePage("Invoices") . "'>Invoices</a></li>
                    <li><a href='#' class='button button--cms" . $this->getActivePage("Users") . "'>Users</a></li>
                    <li><a href='#' class='button button--cms" . $this->getActivePage("API") . "'>API</a></li>
                </ul>
            </nav>
            <footer class='navigation--cms__footer'>
                <a href='#' class='button button--secondary'>Log out</a>
            </footer>
        </aside>
        ";
    }

    private function getActivePage(string $pageName) : string {
        return $pageName === $this->activePage ? "button--active" : "";
    }
}

?>