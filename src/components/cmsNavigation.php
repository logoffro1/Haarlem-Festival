<?php 

class cmsNavigation {
    private string $activePage;
    private accountController $accountController;

    public function __construct(string $activePage, accountController $accountController) {
        $this->activePage = $activePage;
        $this->accountController = $accountController;
    }

    public function render()
    {
        if(isset($_POST['logout'])){ 
            $this->accountController->logout(); 
        }
        echo "
        <aside class='navigation--cms'>
            <header class='navigation--cms__header'>
                <img src='/assets/images/svg/logo.svg' alt=''>
                <a href='#' class='navigation--cms__header__profile'>
                    <img src='' alt=''>
                </a>
            </header>
            <nav class='navigation--cms__body'>
                <ul>
                    <li><a href='./edit-pages.php' class='button button--cms " . $this->getActivePage("Edit Pages") . "''>Edit Pages</a></li>
                    <li><a href='./index.php' class='button button--cms " . $this->getActivePage("Events") . "'>Events</a></li>
                    <li><a href='#' class='button button--cms " . $this->getActivePage("Reservations") . "'>Reservations</a></li>
                    <li><a href='#' class='button button--cms " . $this->getActivePage("Invoices") . "'>Invoices</a></li>
                    <li><a href='#' class='button button--cms " . $this->getActivePage("Users") . "'>Users</a></li>
                    <li><a href='#' class='button button--cms " . $this->getActivePage("API") . "'>API</a></li>
                </ul>
            </nav>
            <footer class='navigation--cms__footer'>
                <form method='POST'>
                    <input type='submit' name='logout' class='button button--secondary' value='Log out'>
                </form>
            </footer>
        </aside>
        ";
    }

    private function getActivePage(string $pageName) : string {
        return $pageName === $this->activePage ? "button--active" : "";
    }
}

?>