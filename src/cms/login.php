<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();
?>

<div class="section--login-wrapper">
    <section class="section--login">
        <h1 class="title">Login</h1>
        
        <form action="" method="post">
            <label for="username">Username or Email</label>
            <input type="text" placeholder="e.g. JohnDoe..."/>

            <label for="username">Password</label>
            <input type="text" placeholder="e.g. JohnDoe123..."/>

            <input type="submit" class="button" value="Login"/>

            <a href="#">Forgot password?</a>
        </form>
    </section>
</div>
