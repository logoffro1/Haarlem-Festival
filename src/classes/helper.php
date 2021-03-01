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
    }

    public function startSession()
    {
        if(!isset($_SESSION)){
            session_start();
        }
    }
}
?>