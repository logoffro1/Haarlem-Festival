<?php
if(isset($_POST['submit']))    
{
    header("Location:/cms/index.php");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once '../classes/autoloader.php';

$accountController = new accountController();

$head = new head("CMS - Login", "page--cms");
$head->render();


?>

<div class="section--login-wrapper">
    <section class="section--login">
        <h1 class="title">Login</h1>
        
        <form action="" method="POST">
            <label for="username">Username or Email</label>
            <input type="text" name="username" placeholder="e.g. JohnDoe..."/>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="e.g. JohnDoe123..."/>

            <input type="submit" name="submit" class="button" value="Login"/>

            <a href="#">Forgot password?</a>
        </form>
    </section>
</div>
