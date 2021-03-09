<?php
include_once '../classes/autoloader.php';
$accountController = new accountController();

if(isset($_POST['submit']))    
{
    $accountController->login();
}
// var_dump($accountController->errors);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$cmsNotification = new cmsNotification('Error', $accountController->errors);

$head = new head("CMS - Login", "page--cms");
$head->render();


?>

<div class="section--login-wrapper">
    <section class="section--login">
        <h1 class="title">Login</h1>
        
        <form action="" method="POST">
            <label for="email">Email</label>
            <input required type="email" name="email" placeholder="e.g. JohnDoe@hotmail.com..."/>

            <label for="password">Password</label>
            <input required type="password" name="password" placeholder="e.g. JohnDoe123..."/>

            <input type="submit" name="submit" class="button" value="Login"/>

            <a href="#">Forgot password?</a>
        </form>
    </section>
    <?php
        $cmsNotification->render();
    ?>
</div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>
