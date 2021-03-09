<?php
class helper
{
    /*
    * encryptPassword function to hash password
    *
    * @param string $password - string that needs hashing
    * @return hashed password
    */
    public function encryptPassword(string $password) : string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /*
    * Redirect function to change pages
    *
    * @param string $url - url to new page
    */
    public function redirect(string $url)
    {
        header("location: $url");
        exit;
    }

    public function refresh()
    {
        header("Refresh: 0");
    }

    public function startSession()
    {
        if(!isset($_SESSION)){
            session_start();
        }
    }

    public function destroySession()
    {
        $this->startSession();

        session_unset();
        session_destroy();
    }

    public function clearCookies()
    {
        if(isset($_POST['remove_cookies'])){
            $past = time() - 3600;
            foreach ( $_COOKIE as $key => $value )
            {
                setcookie( $key, $value, $past, '/' );
            }
        }
    }
}
?>