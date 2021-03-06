<?php 
include_once '../controller/accountController.php';

class cmsNavigation {
    private string $activePage;
    private accountController $accountController;

    public function __construct(string $activePage) {
        $this->activePage = $activePage;
        $this->accountController = new accountController();
    }

    public function render()
    {
        if(isset($_POST['logout'])){ 
            $this->accountController->logout(); 
        }
        echo "
        <aside class='navigation--cms'>
            <header class='navigation--cms__header'>
                <a href='./index.php'>
                    <img src='../assets/images/svg/logo.svg' alt=''>
                </a>
                <a href='./profile-page.php' class='navigation--cms__header__profile'></a>
            </header>
            <nav class='navigation--cms__body'>
                <ul>
                    <li><a href='./edit-pages.php' class='button button--cms " . $this->getActivePage("Edit Pages") . "''>Edit Pages</a></li>
                    <li><a href='./index.php' class='button button--cms " . $this->getActivePage("Events") . "'>Events</a></li>
                    <li><a href='./purchases-overview.php' class='button button--cms " . $this->getActivePage("Purchases") . "'>Purchases</a></li>
                    <li><a href='./user-page.php' class='button button--cms " . $this->getActivePage("Users") . "'>Users</a></li>
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