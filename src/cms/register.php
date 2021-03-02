<?php
if(isset($_POST['submit']))    
{
    header("Location:/cms/index.php");
}

include_once '../classes/autoloader.php';

$accountController = new accountController();

$head = new head("CMS - Register", "page--cms");
$head->render();


?>

<div class="section--login-wrapper">
    <section class="section--login">
        <h1 class="title">Register</h1>
        
        <form action="" method="POST">
            <label for="name">Full name</label>
            <input type="text" name="name" placeholder="e.g. John Doe..."/>

            <label for="email">Email</label>
            <input type="text" name="email" placeholder="e.g. JohnDoe@hotmail.com..."/>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="e.g. JohnDoe123..."/>

            <input type="submit" name="submit" class="button" value="Register"/>

            <a href="login.php">Already have an account? Log in here</a>
        </form>
    </section>
</div>
